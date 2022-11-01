<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'quantity',
        'quantity_type',
        'request_quantity',
        'request_type',
        'delivery_date',
        'delivery_start_time',
        'delivery_end_time',
        'bulking_center',
        'status',
        'new_delivery_date',
        'new_delivery_start_time',
        'new_delivery_end_time',
        'actual_no_of_trays',
        'average_weight',
        'total_price',
        'weight1',
        'weight2',
        'input_id',
    ];


    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    //a delivery request belongs to a bulking center
    public function center()
    {
        return $this->belongsTo(BulkingCenter::class, 'bulking_center');
    }

    //a delivery request has many farm supplies
    public function farm_supplies()
    {
        return $this->hasMany(FarmSupply::class, 'delivery_request_id');
    }


    //a delivery request has many farm requests
    public function farm_requests()
    {
        return $this->hasMany(FarmRequest::class, 'delivery_request_id');
    }

    //
    public function weights()
    {
        return $this->hasMany(Weight::class, 'delivery_request_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'delivery_request_id');
    }
    public function secondweights()
    {
        return $this->hasMany(SecondWeight::class, 'delivery_request_id');
    }
    public function inputs()
    {
        return $this->hasMany(Input::class);
    }
}
