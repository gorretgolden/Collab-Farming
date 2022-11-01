<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\DeliveryCompletedtoFarmer;
use App\Mail\DeliveryCompletedtoStaff;
use App\Mail\DeliveryRequestSubmitted;
use App\Mail\NewDeliveryRequest;
use App\Models\BulkingCenter;
use App\Models\DeliveryRequest;
use App\Models\EmailLog;
use App\Models\FarmRequest;
use App\Models\FarmSupply;
use App\Models\Input;
use App\Models\Payment;
use App\Models\Role;
use App\Models\SecondWeight;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FarmerController extends Controller
{
    //
    // Get delivery request statistics
    public function getDeliveryRequestStats(Request $request)
    {
        $total = DeliveryRequest::where('farmer_id', auth()->user()->id)->count();
        $received = DeliveryRequest::where('farmer_id', auth()->user()->id)
            ->where('status', 'received')
            ->count();
    
        $confirmed = DeliveryRequest::where('farmer_id', auth()->user()->id)
            ->where('status', 'confirmed')
            ->count();

        $statistics = [
            'total' => $total,
            'received' => $received,
            'confirmed' => $confirmed,
            
        ];

        return response(['response' => 'success', 'statistics' => $statistics]);
    }
    public function farmerDeliveries(Request $request){

        $weight = SecondWeight::select('weight2')->where('farmer_id', auth()->user()->id)->sum('weight2');

        return response()->json(compact('weight'));
        // return $quantity;

    }
    public function getFarmerPayments()
    {
        $payments = Payment::select('total_price2')->where('status','confirmed')->where('farmer_id', auth()->user()->id)->sum('total_price2');
        return $payments;



    }


    //
    // Get inputs
    public function getInputs(Request $request)
    {
        $inputs = Input::orderBy('id', 'desc')->get();

        return response(['response' => 'success', 'inputs' => $inputs]);
    }

    //Approve delivery request
    public function approveRequest($id)
    {
        $users = UserRole::with('user')->where('role_id','2')->orWhere('role_id','5')->get();



        $delivery = DeliveryRequest::where('id',$id)->first();

        $delivery->update([
            'status' => 'received'
        ]);
       try{
        $mail = new DeliveryCompletedtoFarmer($delivery);

        EmailLog::create([
            'to' => $delivery->farmer->email,
            'title' => 'Delivery Completed',
            'message' => $mail->render()
        ]);

        Mail::to($delivery->farmer->email)->send($mail);
    }catch (\Exception $e){}

     
    foreach($users as $user){
        try{
            $mailtostaff = new DeliveryCompletedtoStaff($delivery, $user->user->name);


            EmailLog::create([
                'to' => $user->user->email,
                'title' => 'Delivery Completed',
                'message' => $mailtostaff->render()
            ]);
            Mail::to($user->user->email)->send($mailtostaff);
        }catch (\Exception $e){}

        }
        return 'Success';
    }

    //
    // Get bulking center
    public function getBulkingCenters(Request $request)
    {
        $bulking_centers = BulkingCenter::orderBy('id', 'desc')->get();

        return response(['response' => 'success', 'bulking_centers' => $bulking_centers]);
    }


    //
    // Save Delivery/Request
    public function saveDeliveryRequest(Request $request)
    {
        // return $request->all();
        $request->validate([
            'quantity' => '',
            'quantity_type' => '',
            'farmRequests' => '',
            'delivery_date' => 'required',
            'delivery_start_time' => 'required',
            'delivery_end_time' => 'required',
            'bulking_center' => 'required',
            
        ]);

        $start = Carbon::createFromFormat('H:i:s', $request->delivery_start_time . ":00");
        $end = Carbon::createFromFormat('H:i:s', $request->delivery_end_time . ":00");

        $farmRequests = json_decode($request->farmRequests);

        //
        // Save delivery/request
        $deliveryRequest = DeliveryRequest::create([
            'farmer_id' => auth()->user()->id,
            'quantity' => $request->quantity,
            'quantity_type' => $request->quantity_type,
            'delivery_date' => $request->delivery_date,
            'delivery_start_time' => $start->format('H:i:s'),
            'delivery_end_time' => $end->format('H:i:s'),
            'bulking_center' => $request->bulking_center,
            'request_type' => count($farmRequests) == 0 ? 'eggs' : 'feed',
            // 'input_id' => Input::select('name')->where('id',$request->quantity_type)->first(),
        ]);

        foreach ($farmRequests as $key => $value) {
            $input = Input::find([$value->requestType]);
            $farm_request = new FarmRequest();
            $farm_request->delivery_request_id = $deliveryRequest->id;
            // request_quantity,request_input

            $farm_request->request_quantity = $value->requestQuantity;
            $farm_request->status = "pending";
            $farm_request->request_input = $input->first() ? $input->first()->inputs : null;
            $farm_request->save();
            $farm_request->inputs()->attach($input);
        }

        // Save farm requests in their own table
        if (count($farmRequests) > 0) {
            foreach ($farmRequests as $farm) {
                FarmSupply::create([
                    'delivery_request_id' => $deliveryRequest->id,
                    'product_quantity' => $farm->requestQuantity,
                    'product_type' => $farm->requestType,
                ]);
            }
        }

        //
        // Send email to farmer
        try {
            $emailInfo = [
                'receiver_name' => auth()->user()->name,
                'quantity' => $deliveryRequest->quantity,
                'quantity_type' => $deliveryRequest->quantity_type,
                'farm_supplies' => $farmRequests,
                'delivery_date' => date('d/M/Y', strtotime($deliveryRequest->delivery_date)),
                'delivery_start_time' => $deliveryRequest->delivery_start_time,
                'delivery_end_time' => $deliveryRequest->delivery_end_time,
                'bulking_center' => $deliveryRequest->center->name,
            ];

            $mail = new DeliveryRequestSubmitted($emailInfo);

            EmailLog::create([
                'to' => auth()->user()->email,
                'title' => 'Delivery/Input Request Submitted',
                'message' => $mail->render()
            ]);

            Mail::to(auth()->user()->email)->send($mail);
        } catch (\Exception $ex) {
        }


        //
        // Send email to collection agent/admins
        $roles = UserRole::where('role_id', 2)->orWhere('role_id', 5)->get();

        foreach ($roles as $role) {
            $emailInfoTwo = [
                'receiver_name' => $role->user->name,
                'farmer_name' => auth()->user()->name,
                'quantity' => $deliveryRequest->quantity,
                'quantity_type' => $deliveryRequest->quantity_type,
                'farm_supplies' => $farmRequests,
                'delivery_date' => date('d/M/Y', strtotime($deliveryRequest->delivery_date)),
                'delivery_start_time' => $deliveryRequest->delivery_start_time,
                'delivery_end_time' => $deliveryRequest->delivery_end_time,
                'bulking_center' => $deliveryRequest->center->name,
            ];

            try {
                $mailTwo = new NewDeliveryRequest($emailInfoTwo);

                EmailLog::create([
                    'to' => $role->user->email,
                    'title' => 'New Delivery/Input Request Submitted',
                    'message' => $mailTwo->render()
                ]);

                Mail::to($role->user->email)->send($mailTwo);
            } catch (\Exception $ex) {
            }
        }

        return response(['response' => 'success', 'message' => "Delivery request submitted successfully"]);
    }
}
