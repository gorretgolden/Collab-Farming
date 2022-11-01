<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\AgentsAdminsDeliveryRequestAccepted;
use App\Mail\AgentsAdminsFeedRequestAccepted;
use App\Mail\FarmerDeliveryRequestAccepted;
use App\Mail\FarmerFeedRequestAccepted;
use App\Models\DeliveryRequest;
use App\Models\EmailLog;
use App\Models\FarmSupply;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountsController extends Controller
{
    //
    // Get accounts  statistics
    public function accountsStats(Request $request)
    {
        $eggRequests = DeliveryRequest::where('status', 'pending')
            ->where('request_type', 'eggs')
            ->count();

        $feedRequests = DeliveryRequest::where('status', 'pending')
            ->where('request_type', 'feed')
            ->count();

        $statistics = [
            'eggs' => $eggRequests,
            'feeds' => $feedRequests,
        ];

        return response(['response' => 'success', 'statistics' => $statistics]);
    }

// $users = User::whereHas('userroles',function ($query){
        //     $query->where('role_id','2')->orWhere('role_id','5');
        // })->get();

    //
    // Get egg delivery requests
    public function eggDeliveryRequests()
    {
        // $eggRequests = DeliveryRequest::all();
        $eggRequests = DeliveryRequest::with('farmer')
            ->with('center')
            ->with('farm_supplies')
            ->with('farm_requests')
            ->with('weights')
            ->with('secondweights')
            ->orderBy("created_at","desc")
            ->get();

        return response(['response' => 'success', 'egg_requests' => $eggRequests]);
    }
    public function eggDeliveryRequestsCollector()
    {
        // $eggRequests = DeliveryRequest::all();
        $eggRequests = DeliveryRequest::where(function ($query) {
            $query->where('status', '=', 'received')
                  ->orWhere('status', '=', 'confirmed')
                  ->orWhere('status', '=', 'declined');
        })->with('farmer')
            ->with('center')
            ->with('farm_supplies')
            ->with('farm_requests')
            ->with('weights')
            ->with('secondweights')
            ->orderBy("created_at","desc")
            ->get();

        return response(['response' => 'success', 'egg_requests' => $eggRequests]);
    }
    public function eggDeliveryRequestsPayments()
    {       
        // $eggRequests = DeliveryRequest::all();
        $eggRequests = DeliveryRequest::where(function ($query) {
            $query->where('status', '=', 'received');
               
        })->with('farmer')
            ->with('center')
            ->with('farm_supplies')
            ->with('farm_requests')
            ->with('weights')
            ->with('secondweights')
            ->with('payments')
            ->whereHas('weights')
            ->whereHas('secondweights')
            ->orderBy("created_at","desc")
            ->get();

        return response(['response' => 'success', 'egg_requests' => $eggRequests]);
    }
    public function eggDeliveryRequestsPaymentsFarmer()
    {       
        // $eggRequests = DeliveryRequest::all();
        $eggRequests = DeliveryRequest::where(function ($query) {
            $query->where('status', '=', 'received');
               
        })->with('farmer')
            ->with('center')
            ->with('farm_supplies')
            ->with('farm_requests')
            ->with('weights')
            ->with('secondweights')
            ->with('payments')
            ->whereHas('weights')
            ->whereHas('secondweights')
            ->orderBy("created_at","desc")
            ->get();

        return response(['response' => 'success', 'egg_requests' => $eggRequests]);
    }


    // 
    // Accept delivery request
    public function acceptDeliveryRequest(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'withEdits' => 'required',
            'new_delivery_date' => '',
            'new_delivery_start_time' => '',
            'new_delivery_end_time' => '',
        ]);

        $delivery = DeliveryRequest::find($request->id);

        // If accepted with edits
        if ($request->withEdits) {
            $delivery->new_delivery_date = $request->newDeliveryDate;
            $delivery->new_delivery_start_time = $request->newDeliveryStartTime;
            $delivery->new_delivery_end_time = $request->newDeliveryEndTime;
        }

        $delivery->status = 'confirmed';
        $delivery->save();

        // 
        // Check if it's a delivery or feed request
        if ($delivery->request_type == 'eggs') {
            // Whether the request has edits or not
            $emailSubject = $request->withEdits == 'true' ? "Delivery Request Accepted with Edits" : "Delivery Request Accepted";

            // 
            // Send email to farmer
            try {
                $emailInfo = [
                    // Dynamic subject depending whether there is an edit or not
                    'subject' => $emailSubject,

                    'receiver_name' => $delivery->farmer->name,
                    'quantity' => $delivery->quantity,
                    'quantity_type' => $delivery->quantity_type,
                    'delivery_date' => date('d/M/Y', strtotime($delivery->delivery_date)),
                    'delivery_start_time' => $delivery->delivery_start_time,
                    'delivery_end_time' => $delivery->delivery_end_time,
                    'bulking_center' => $delivery->center->name,

                    'with_edits' => $request->withEdits,
                    'new_delivery_date' => $delivery->new_delivery_date,
                    'new_delivery_start_time' => $delivery->new_delivery_start_time,
                    'new_delivery_end_time' => $delivery->new_delivery_end_time,
                ];

                $mail = new FarmerDeliveryRequestAccepted($emailInfo);

                EmailLog::create([
                    'to' => $delivery->farmer->email,
                    'title' => $emailSubject,
                    'message' => $mail->render()
                ]);

                Mail::to($delivery->farmer->email)->send($mail);
            } catch (\Exception $ex) {
            }

            // 
            // Send email to collection agents/admins
            $roles = UserRole::where('role_id', 2)->orWhere('role_id', 5)->get();

            foreach ($roles as $role) {
                $emailInfoTwo = [
                    // Dynamic subject depending whether there is an edit or not
                    'subject' => $emailSubject,

                    'receiver_name' => $role->user->name,
                    'farmer_name' => $delivery->farmer->name,
                    'quantity' => $delivery->quantity,
                    'quantity_type' => $delivery->quantity_type,
                    'delivery_date' => date('d/M/Y', strtotime($delivery->delivery_date)),
                    'delivery_start_time' => $delivery->delivery_start_time,
                    'delivery_end_time' => $delivery->delivery_end_time,
                    'bulking_center' => $delivery->center->name,

                    'with_edits' => $request->withEdits,
                    'new_delivery_date' => $delivery->new_delivery_date,
                    'new_delivery_start_time' => $delivery->new_delivery_start_time,
                    'new_delivery_end_time' => $delivery->new_delivery_end_time,
                ];

                try {
                    $mailTwo = new AgentsAdminsDeliveryRequestAccepted($emailInfoTwo);

                    EmailLog::create([
                        'to' => $role->user->email,
                        'title' => $emailSubject,
                        'message' => $mailTwo->render()
                    ]);

                    Mail::to($role->user->email)->send($mailTwo);
                } catch (\Exception $ex) {
                }
            }
        } else {
            // 
            // Update the product quantity if edits happened
            if ($request->withEdits == 'true') {
                $farmRequests = json_decode($request->farmRequests);

                foreach ($farmRequests as $req) {
                    // FarmSupply::find($req->id)->update(['product_quantity', $req->product_quantity]);
                    $farm = FarmSupply::find($req->id);
                    $farm->product_quantity = $req->product_quantity;
                    $farm->save();
                }
            }

            // Whether the request has edits or not
            $emailSubject = $request->withEdits == 'true' ? "Input Request Accepted with Edits" : "Input Request Accepted";

            $supplies = FarmSupply::where('delivery_request_id', $delivery->id)
                ->with('product')
                ->get();

            // 
            // Send email to farmer
            try {
                $emailInfo = [
                    // Dynamic subject depending whether there is an edit or not
                    'subject' => $emailSubject,

                    'receiver_name' => $delivery->farmer->name,
                    'quantity' => $delivery->quantity,
                    'quantity_type' => $delivery->quantity_type,
                    'delivery_date' => date('d/M/Y', strtotime($delivery->delivery_date)),
                    'delivery_start_time' => $delivery->delivery_start_time,
                    'delivery_end_time' => $delivery->delivery_end_time,
                    'bulking_center' => $delivery->center->name,

                    'farm_supplies' => $supplies,

                    'with_edits' => $request->withEdits == 'true' ? true : false,
                    'new_delivery_date' => $delivery->new_delivery_date,
                    'new_delivery_start_time' => $delivery->new_delivery_start_time,
                    'new_delivery_end_time' => $delivery->new_delivery_end_time,
                ];

                $mail = new FarmerFeedRequestAccepted($emailInfo);

                EmailLog::create([
                    'to' => $delivery->farmer->email,
                    'title' => $emailSubject,
                    'message' => $mail->render()
                ]);

                Mail::to($delivery->farmer->email)->send($mail);
            } catch (\Exception $ex) {
            }


            // 
            // Send email to collection agents/admins
            $roles = UserRole::where('role_id', 2)->orWhere('role_id', 5)->get();

            foreach ($roles as $role) {
                $emailInfoTwo = [
                    // Dynamic subject depending whether there is an edit or not
                    'subject' => $emailSubject,

                    'receiver_name' => $role->user->name,
                    'farmer_name' => $delivery->farmer->name,
                    'quantity' => $delivery->quantity,
                    'quantity_type' => $delivery->quantity_type,
                    'delivery_date' => date('d/M/Y', strtotime($delivery->delivery_date)),
                    'delivery_start_time' => $delivery->delivery_start_time,
                    'delivery_end_time' => $delivery->delivery_end_time,
                    'bulking_center' => $delivery->center->name,

                    'farm_supplies' => $supplies,

                    'with_edits' => $request->withEdits == 'true' ? true : false,
                    'new_delivery_date' => $delivery->new_delivery_date,
                    'new_delivery_start_time' => $delivery->new_delivery_start_time,
                    'new_delivery_end_time' => $delivery->new_delivery_end_time,
                ];

                try {
                    $mailTwo = new AgentsAdminsFeedRequestAccepted($emailInfoTwo);

                    EmailLog::create([
                        'to' => $role->user->email,
                        'title' => $emailSubject,
                        'message' => $mailTwo->render()
                    ]);

                    Mail::to($role->user->email)->send($mailTwo);
                } catch (\Exception $ex) {
                }
            }
        }

        return response(['response' => 'success', 'message' => "Request accepted"]);
    }
}
