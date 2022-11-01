<?php

use App\Http\Controllers\API\AccountsController;
use App\Http\Controllers\API\FarmerController;
use App\Http\Controllers\API\settings\CenterController;
use App\Http\Controllers\API\settings\PriceController;
use App\Http\Controllers\API\settings\InputController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Unprotected routes go below 

Route::post('/login', [App\Http\Controllers\API\Auth\AuthControllerAPI::class, 'login']);

//protected routes go below the route group

Route::group(['middleware' => ['auth:api']], function () {

    //Routes for all the users in the system

    Route::get('/user', [App\Http\Controllers\API\Auth\AuthControllerAPI::class, 'getUserDetails']);

    Route::get('/logout', [App\Http\Controllers\API\Auth\AuthControllerAPI::class, 'logOut']);


    /*------------------------------------Ronald - Start Accounts routes ------------------------*/
    Route::prefix('enumerator')->group(function () {

        Route::get('/get-member-district', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getDistricts']);

        Route::get('/get-member-sub-county/{id}', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getSubCountry']);

        Route::post('/get-member-parish', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getParish']);
        Route::post('/get-member-village', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getVillage']);

        Route::post('/save-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'saveProfile']);

        Route::get('/get-reports', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getReports']);

        Route::get('/get-counts', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'countProfiles']);

        Route::get('/get-profile/{id}', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getProfile']);
        Route::post('/save-data', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'saveFarmerProfile']);


    });
    /*------------------------------------Ronald - End Accounts routes ------------------------*/

    //admin route grouping where all the admin routes will be  added 

    Route::group(['prefix' => 'admin'], function () {




        /*------------------------------------Ivans route in the  admin route group------------------------*/

        //email logs for route
        Route::get('/emails/aggregated', [App\Http\Controllers\API\EmailLogsController::class, 'emailsAggregated']);
        Route::get('/emails/actual', [App\Http\Controllers\API\EmailLogsController::class, 'emailsActual']);

        //Account managment routes 
        Route::post('/create-account', [App\Http\Controllers\API\UserAccountApi::class, 'createAccount']);
        Route::get('/get-users', [App\Http\Controllers\API\UserAccountApi::class, 'getUsers']);
        Route::get('/get-collectors', [App\Http\Controllers\API\UserAccountApi::class, 'getCollectors']);


        Route::get('/delete-user/{id}', [App\Http\Controllers\API\UserAccountApi::class, 'DeleteUser']);
        Route::post('/register', [App\Http\Controllers\API\Auth\AuthControllerAPI::class, 'register']);



        /*------------------------------------Ivan's end of route in the  admin route group------------------------*/




        /*------------------------------------Arnolds route in the  admin route group------------------------*/


        //load settings-bulking center interface
        Route::get('/centers', [App\Http\Controllers\API\settings\CenterController::class, 'index']);

        //bulking center routes
        Route::prefix('/center')->group(function () {
            Route::post('/store', [App\Http\Controllers\API\settings\CenterController::class, 'store']);
            Route::put('update-center/{id}', [App\Http\Controllers\API\settings\CenterController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\API\settings\CenterController::class, 'destroy']);
        });

        //load settings-input interface 
        Route::get('/inputs', [App\Http\Controllers\API\settings\InputController::class, 'index']);

        //input routes
        Route::prefix('/input')->group(function () {
            Route::post('/store', [App\Http\Controllers\API\settings\InputController::class, 'store']);
            Route::get('/input-list', [App\Http\Controllers\API\settings\InputController::class, 'store']);
            Route::put('/update-input/{id}', [App\Http\Controllers\API\settings\InputController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\API\settings\InputController::class, 'destroy']);
        });


        //load settings-prices interface 
        Route::get('/prices', [App\Http\Controllers\API\settings\PriceController::class, 'index']);

        //newprice routes
        Route::prefix('/price')->group(function () {
            Route::post('/store', [App\Http\Controllers\API\settings\PriceController::class, 'store']);
            Route::put('/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'destroy']); 
            Route::get('/latest', [App\Http\Controllers\API\settings\PriceController::class, 'latest']);
            Route::get('/price-list', [App\Http\Controllers\API\settings\PriceController::class, 'getAllPrices']);
            Route::post('/save_total/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'saveTotalPrice']);

        });


        /*------------------------------------Arnolds end of route in the  admin route group------------------------*/


        /*------------------------------------Ronald - Start Accounts routes ------------------------*/
        Route::prefix('accounts')->group(function () {
            Route::get('/statistics', [AccountsController::class, 'accountsStats']);
            Route::get('/egg-requests', [AccountsController::class, 'eggDeliveryRequests']);
            Route::get('/egg-requests-collector', [AccountsController::class, 'eggDeliveryRequestsCollector']);
            Route::get('/egg-requests-payments', [AccountsController::class, 'eggDeliveryRequestsPayments']);
            Route::get('/egg-requests-payments-farmer', [AccountsController::class, 'eggDeliveryRequestsPaymentsFarmer']);
            Route::post('/accept-delivery', [AccountsController::class, 'acceptDeliveryRequest']);
        });
        /*------------------------------------Ronald - End Accounts routes ------------------------*/
    });


    Route::prefix('farmer')->group(function () {
        Route::get('statistics', [FarmerController::class, 'getDeliveryRequestStats']);
        Route::get('deliveries', [FarmerController::class, 'farmerDeliveries']);
        Route::get('payments', [FarmerController::class, 'getFarmerPayments']);
        Route::get('inputs', [FarmerController::class, 'getInputs']);
        Route::get('bulking-centers', [FarmerController::class, 'getBulkingCenters']);
        Route::post('saveDeliveryRequest', [FarmerController::class, 'saveDeliveryRequest']);
    });
});
Route::post('/store', [App\Http\Controllers\API\settings\CenterController::class, 'store']);
Route::put('update-center/{id}', [App\Http\Controllers\API\settings\CenterController::class, 'update']);
Route::post('/save_total/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'saveTotalPrice']);
Route::post('/second_weight/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'secondWeight']);
Route::post('/get-member-parish', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getParish']);
Route::post('/get-member-village', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getVillage']);
Route::post('/save-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'saveFarmerProfile']);
Route::post('/save-household-details', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'saveHouseHoldDetails']);
Route::post('/save-step-three', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'stepThree']);
Route::post('/save-step-four', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'stepFour']);
Route::post('/save-step-five', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'stepFive']);
Route::post('/save-step-six', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'stepSix']);
Route::post('/save-step-seven', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'stepSeven']);
Route::get('/farmer-profile-list', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getAllProfiles']);
Route::delete('/delete-profile/{id}', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'destroy']);

//edit farmer profile
Route::post('/edit-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'editAddressDetails']);
Route::post('/two-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'editStepTwo']);
Route::post('/three-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'editStepThree']);
Route::post('/four-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'editStepFour']);
Route::post('/five-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'editStepFive']);
Route::post('/six-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'editStepSix']);
Route::post('/seven-farmer-profile', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'editStepSeven']);


Route::post('/save-price', [App\Http\Controllers\API\settings\PriceController::class, 'savePrice']);
Route::get('/price-list', [App\Http\Controllers\API\settings\PriceController::class, 'index']);
Route::get('/input-list', [App\Http\Controllers\API\settings\InputController::class, 'index']);
Route::post('/store-input', [App\Http\Controllers\API\settings\InputController::class, 'store']);
Route::post('/update-input/{id}', [App\Http\Controllers\API\settings\InputController::class, 'update']);
Route::post('/update-center/{id}', [App\Http\Controllers\API\settings\CenterController::class, 'update']);


Route::post('/approveDelivery/{id}', [FarmerController::class, 'approveRequest']);
Route::delete('/delete-input/{id}', [App\Http\Controllers\API\settings\InputController::class, 'destroy']);
Route::delete('/delete-price/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'destroy']); 
Route::delete('/delete-center/{id}', [App\Http\Controllers\API\settings\CenterController::class, 'destroy']);

Route::get('/get-profile/{id}', [App\Http\Controllers\API\Profiling\ProfilingApi::class, 'getProfile']);

//update payment status
Route::post('/confirm-payment-farmer/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'confirmPaymentFarmer']); 
Route::post('/confirm-payment-accounts/{id}', [App\Http\Controllers\API\settings\PriceController::class, 'confirmPaymentAccount']); 
Route::get('/count-centers', [App\Http\Controllers\API\settings\CenterController::class, 'getCenters']);














/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
