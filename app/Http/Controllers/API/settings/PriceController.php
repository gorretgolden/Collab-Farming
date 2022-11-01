<?php

namespace App\Http\Controllers\API\settings;

use App\Http\Controllers\Controller;
use App\Mail\DeliveryWeightAddedAdmins;
use App\Mail\DeliveryWeightAddedFarmer;
use App\Mail\NewPriceAdded;
use App\Models\BulkingCenter;
use App\Models\DeliveryRequest;
use App\Models\EmailLog;
use App\Models\Payment;
use App\Models\Weight;
use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\SecondWeight;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Mail;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //return new prices  in terms of latest created
       return Price::orderBy('priceCreated','DESC')->get();
    }

    public function latest()
    {
        return Price::select('newprice')->orderBy('priceCreated','DESC')->first();

        $latestPrice = Price::select('newprice')->orderBy('priceCreated','DESC')->first();
        return response()->json(compact('latestPrice'));
    }
    public function getAllPrices(){
        $all_prices = Price::select()->orderBy('priceCreated','DESC')->get();
        return $all_prices;

    }
    public function savePrice(Request $request)
    {
        if($request->newprice)
        {
            Price::updateOrCreate([
                'newprice'=>$request->newprice
            ]);
            $farmers = UserRole::with('user')->where('role_id','3')->get();

            foreach($farmers as $farmer){
                try{
                    $mail = new NewPriceAdded($farmer->user->name,$request->newprice);
    
                    EmailLog::create([
                        'to' => $farmer->user->email,
                        'title' => 'New Price Added',
                        'message' => $mail->render()
                    ]);
                    Mail::to($farmer->user->email)->send($mail);
    
                }catch(\Exception $e){}
            }
    
       }
        
        return 'Success';

    }

    /**=>
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function saveTotalPrice(Request $request, $id)
    {
        
        $delivery_request = DeliveryRequest::find($id);
        $farmer = User::where('id',$delivery_request->farmer_id)->first();
        $bulking_center = BulkingCenter::find($request->bulking_center);
        Weight::updateOrCreate([
            'delivery_request_id' => $id,
            'actual_no_of_trays' => $request->trays,
            'avg_weight_1' => $request->weight,
            'average_weight' => $request->weight,
            'total_price' => $request->result,
            'weight1' => $request->weight1,
            'bulking_center' => $request->bulking_center,
            'farmer_id' => $delivery_request->farmer_id
        ]);



        $emailInfo = [
            'actual_no_of_trays' => $request->trays,
            'avg_weight_1' => $request->weight,
            'total_price' => $request->result,
            'weight1' => $request->weight1,
            'farmer_email' => $farmer->email,
            'farmer_name' => $farmer->name,
            'quantity_to_deliver' => $delivery_request->quantity,
            'quantity_type' => $delivery_request->quantity_type,
            'bulking_center' => $bulking_center->name,
            'current_price' => $request->latestprice
        ];

        try{
            $mailTo = new DeliveryWeightAddedFarmer($emailInfo);

            EmailLog::create([
                'to' => $farmer->email,
                'title' => 'Delivery Weight Added',
                'message' => $mailTo->render()
            ]);
    
            Mail::to($farmer->email)->send($mailTo);

        }catch  (\Exception $ex){

        }

        // $users = User::whereHas('userroles',function ($query){
        //     $query->where('role_id','2')->orWhere('role_id','5');
        // })->get();
        $user_details = UserRole::with('user')->where('role_id','2')->orWhere('role_id','5')->get();


        foreach($user_details as $user){
            $emailInfo = [
                'actual_no_of_trays' => $request->trays,
                'avg_weight_1' => $request->weight,
                'total_price' => $request->result,
                'weight1' => $request->weight1,
                'farmer_email' => $user->user->email,
                'farmer_name' => $user->user->name,
                'quantity_to_deliver' => $delivery_request->quantity,
                'quantity_type' => $delivery_request->quantity_type,
                'bulking_center' => $bulking_center->name,
                'current_price' => $request->latestprice
            ];
    
            try{
                $mailTo = new DeliveryWeightAddedAdmins($emailInfo);
    
                EmailLog::create([
                    'to' => $user->user->email,
                    'title' => 'Delivery Weight Added',
                    'message' => $mailTo->render()
                ]);
        
                Mail::to($user->user->email)->send($mailTo);
    
            }catch  (\Exception $ex){
    
            }

        }
      
    

        return ('success');

    }
    public function confirmPaymentAccount($id){
        $payment = Payment::where('delivery_request_id',$id)->first();
        $payment->update([
            'status' => 'confirmed',
        ]);
        return 'success';

    }
    public function confirmPaymentFarmer($id){
        $payment = Payment::where('delivery_request_id',$id)->first();
        $payment->update([
            'farmer_status' => 'confirmed',
        ]);
        return 'success';

        
    }
    public function secondWeight(Request $request, $id)
    {
        $delivery_request = DeliveryRequest::find($id);
        $farmer = User::where('id',$delivery_request->farmer_id)->first();
        $bulking_center = BulkingCenter::find($request->bulking_center);

        SecondWeight::updateOrCreate([
            'delivery_request_id' => $id,
            'actual_no_of_trays2' => $request->trays,
            'total_price2' => $request->result,
            'weight2' => $request->weight1,
            'avg_weight_2' => $request->weight,
            'bulking_center' => $request->bulking_center,
            'current_price' => $request->latestprice,
            'farmer_id' => $delivery_request->farmer_id


        ]);

        Payment::create([
            'delivery_request_id' => $id,
            'total_price2' => $request->result,
            'status' => 'pending',
            'farmer_status' => 'pending',
            'farmer_id' => $delivery_request->farmer_id
        ]);

    

        $emailInfo = [
            'actual_no_of_trays2' => $request->trays,
            'avg_weight_2' => $request->weight,
            'total_price2' => $request->result,
            'weight2' => $request->weight1,
            'farmer_email' => $farmer->email,
            'farmer_name' => $farmer->name,
            'quantity_to_deliver' => $delivery_request->quantity,
            'quantity_type' => $delivery_request->quantity_type,
            'bulking_center' => $bulking_center->name,
            'current_price' => $request->latestprice
        ];

        try{
            $mailTo = new DeliveryWeightAddedFarmer($emailInfo);

            EmailLog::create([
                'to' => $farmer->email,
                'title' => 'Delivery Weight Added',
                'message' => $mailTo->render()
            ]);
    
            Mail::to($farmer->email)->send($mailTo);

        }catch  (\Exception $ex){

        }

        // $users = User::whereHas('userroles',function ($query){
        //     $query->where('role_id','2')->orWhere('role_id','5');
        // })->get();
        $user_details = UserRole::with('user')->where('role_id','2')->orWhere('role_id','5')->get();


        foreach($user_details as $user){
            $emailInfo = [
                'actual_no_of_trays' => $request->trays,
                'avg_weight_2' => $request->weight,
                'total_price' => $request->result,
                'weight1' => $request->weight1,
                'farmer_email' => $user->user->email,
                'farmer_name' => $user->user->name,
                'quantity_to_deliver' => $delivery_request->quantity,
                'quantity_type' => $delivery_request->quantity_type,
                'bulking_center' => $bulking_center->name,
                'current_price' => $request->latestprice
            ];
    
            try{
                $mailTo = new DeliveryWeightAddedAdmins($emailInfo);
    
                EmailLog::create([
                    'to' => $user->user->email,
                    'title' => 'Delivery Weight Added',
                    'message' => $mailTo->render()
                ]);
        
                Mail::to($user->user->email)->send($mailTo);
    
            }catch  (\Exception $ex){
    
            }

        }
      
    

        return ('success');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save price created
        $newprices = new Price();
        $newprices ->  newprice = $request -> price["newprice"];

        $newprices -> save();
        return $newprices;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //edit price
         $existingprice = Price::find( $id );
         if($existingprice){
             $existingprice -> newprice = $request -> price["newprice"];
             $existingprice -> save();
             return $existingprice;
 
         }
         return "No price found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete price
       $existingprice = Price::find( $id );
       
       if($existingprice){
        $existingprice -> delete();
        return "Price succesfully deleted.";
    }
    return "Price not found";
    
    }
}
