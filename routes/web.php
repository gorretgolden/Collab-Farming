<?php

use App\Models\FarmSupply;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::any('{slug}', [App\Http\Controllers\HomeController::class, 'index']);
Route::any('{slug}/{slug2}', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/approve/{id}', [App\Http\Controllers\FarmerController::class, 'approveRequest']);




// Emails - this will be use to render emails in the browser during designing only

Route::group(['prefix' => 'emails'], function () {
    Route::get('/delivery-request-submitted', function () {

        $emailInfo = [
            'receiver_name' => 'Ronald Ngarombo',
            'quantity' => 23,
            'quantity_type' => 'Trays',
            'request_quantity' => 90,
            'request_type' => 'Bags of chicken Feed',
            'delivery_date' => date('d/M/Y'),
            'delivery_start_time' => '10:00AM',
            'delivery_end_time' => '2:00PM',
            'bulking_center' => 'Kampala Central 1',
        ];

        return new App\Mail\DeliveryRequestSubmitted($emailInfo);
    });

    Route::get('/new-delivery-request', function () {

        $emailInfo = [
            'receiver_name' => 'Titus Opio',
            'farmer_name' => 'Ronald Ngarombo',
            'quantity' => 23,
            'quantity_type' => 'Trays',
            'request_quantity' => 90,
            'request_type' => 'Bags of chicken Feed',
            'delivery_date' => date('d/M/Y'),
            'delivery_start_time' => '10:00AM',
            'delivery_end_time' => '2:00PM',
            'bulking_center' => 'Kampala Central 1',
        ];

        return new App\Mail\NewDeliveryRequest($emailInfo);
    });

    Route::get('/farmer-delivery-request-accepted', function () {

        $emailInfo = [
            'subject' => 'Dynamic Email Subject',

            'receiver_name' => 'Titus Opio',
            'quantity' => 23,
            'quantity_type' => 'Trays',
            'delivery_date' => date('d/M/Y'),
            'delivery_start_time' => '10:00AM',
            'delivery_end_time' => '2:00PM',
            'bulking_center' => 'Kampala Central 1',

            'with_edits' => true,
            'new_delivery_date' => date('d/M/Y'),
            'new_delivery_start_time' =>  '15:00',
            'new_delivery_end_time' =>  '17:00AM',
        ];

        return new App\Mail\FarmerDeliveryRequestAccepted($emailInfo);
    });

    Route::get('/agents-admins-delivery-request-accepted', function () {

        $emailInfo = [
            'subject' => 'Dynamic Email Subject',

            'receiver_name' => 'Titus Opio',
            'farmer_name' => 'The Farmer',
            'quantity' => 23,
            'quantity_type' => 'Trays',
            'delivery_date' => date('d/M/Y'),
            'delivery_start_time' => '10:00AM',
            'delivery_end_time' => '2:00PM',
            'bulking_center' => 'Kampala Central 1',

            'with_edits' => true,
            'new_delivery_date' => date('d/M/Y'),
            'new_delivery_start_time' =>  '15:00',
            'new_delivery_end_time' =>  '17:00AM',
        ];

        return new App\Mail\AgentsAdminsDeliveryRequestAccepted($emailInfo);
    });


    Route::get('/farmer-feed-request-accepted', function () {

        $supplies = FarmSupply::where('delivery_request_id', 16)
            ->with('product')
            // ->with('farm_supplies', 'farm_supplies.product')
            ->get();

        // dd($supplies[2]->product->inputs);

        $emailInfo = [
            'subject' => 'Dynamic Email Subject',

            'receiver_name' => 'Titus Opio',
            'quantity' => 23,
            'quantity_type' => 'Bags of Chicken feed',
            'delivery_date' => date('d/M/Y'),
            'delivery_start_time' => '10:00AM',
            'delivery_end_time' => '2:00PM',
            'bulking_center' => 'Kampala Central 1',

            'farm_supplies' => $supplies,
            'with_edits' => true,
            'new_delivery_date' => date('d/M/Y'),
            'new_delivery_start_time' =>  '15:00',
            'new_delivery_end_time' =>  '17:00AM',
        ];

        return new App\Mail\FarmerFeedRequestAccepted($emailInfo);
    });


    Route::get('/agents-admins-feed-request-accepted', function () {

        $supplies = FarmSupply::where('delivery_request_id', 16)
            ->with('product')
            // ->with('farm_supplies', 'farm_supplies.product')
            ->get();

        // dd($supplies[2]->product->inputs);

        $emailInfo = [
            'subject' => 'Dynamic Email Subject',

            'receiver_name' => 'Titus Opio',
            'farmer_name' => 'The Farmer',
            'delivery_date' => date('d/M/Y'),
            'delivery_start_time' => '10:00AM',
            'delivery_end_time' => '2:00PM',
            'bulking_center' => 'Kampala Central 1',

            'farm_supplies' => $supplies,
            'with_edits' => true,
            'new_delivery_date' => date('d/M/Y'),
            'new_delivery_start_time' =>  '15:00',
            'new_delivery_end_time' =>  '17:00AM',
        ];

        return new App\Mail\AgentsAdminsFeedRequestAccepted($emailInfo);
    });


    Route::get('/payment-effected-farmer', function () {

        $emailInfo = [
            'receiver_name' => 'Titus Opio',
            'amount' => number_format(900000),
            'quantity' => 23,
            'average_weight' => 12.1,
            'delivery_date' => date('d/M/Y'),
            'bulking_center' => 'Kampala Central 1',
            'weighed_by' => 'Ronald Ngarombo',
        ];

        return new App\Mail\PaymentEffectedFarmer($emailInfo);
    });

    Route::get('/payment-effected-admins-accounts', function () {

        $emailInfo = [
            'receiver_name' => 'Titus Opio',
            'farmer_name' => 'The Cool Farmer',
            'amount' => number_format(900000),
            'quantity' => 23,
            'average_weight' => 12.1,
            'delivery_date' => date('d/M/Y'),
            'bulking_center' => 'Kampala Central 1',
            'weighed_by' => 'Ronald Ngarombo',
        ];

        return new App\Mail\PaymentEffectedAdminsAccounts($emailInfo);
    });


    Route::get('/payment-confirmed-farmer', function () {

        $emailInfo = [
            'receiver_name' => 'Titus Opio',
            'quantity' => 23,
            'bulking_center' => 'Kampala Central 1',
            'delivery_date' => date('d/M/Y'),
            'average_weight' => 12.1,
            'average_price' => number_format(12500),
            'amount' => number_format(900000),
        ];

        return new App\Mail\PaymentConfirmedFarmer($emailInfo);
    });


    Route::get('/payment-confirmed-admins-accounts', function () {

        $emailInfo = [
            'receiver_name' => 'Titus Opio',
            'farmer_name' => 'The Cool Farmer',
            'quantity' => 23,
            'bulking_center' => 'Kampala Central 1',
            'delivery_date' => date('d/M/Y'),
            'average_weight' => 12.1,
            'average_price' => number_format(12500),
            'amount' => number_format(900000),
        ];

        return new App\Mail\PaymentConfirmedAdminsAccounts($emailInfo);
    });


    Route::get('/system-accounts-update', function () {

        $emailInfo = [
            'new_enumerators'=>2,
            'total_enumerators' => 4,
            'enum_collected_data' => 6,
            'weekly_emails' => 8,
            'new_egg_farmers' => 10,
            'data_profiled' => 12,
            'profiled_districts' => "Kabaale, Kampala, Kaabong",
            'updates_deployed' => 16,
            'avg_egg_price' => number_format(12500),
            'no_delivery_requests' => 20,
            'no_input_requests' => 22,
        ];

        return new App\Mail\SystemAccountsUpdate($emailInfo);
    });


    Route::get('/system-enumerator-update', function () {

        $emailInfo = [
            'data_profiled' => 12,
            'profiled_districts' => "Kabaale, Kampala, Kaabong",
        ];

        return new App\Mail\SystemEnumeratorUpdate($emailInfo);
    });


    Route::get('/system-farmer-update', function () {

        $emailInfo = [
            'avg_egg_price' => number_format(12500),
            'no_delivery_requests' => 20,
            'no_input_requests' => 22,
        ];

        return new App\Mail\SystemFarmerUpdate($emailInfo);
    });
});


//Route::get('/forgot-password',)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
