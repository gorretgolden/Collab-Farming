<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmRequest extends Model
{
    use HasFactory;

    public function inputs()
    {
        return $this->belongsToMany(Input::class);
    }

    //a farm request belongs to a delivery request
    public function deliveryRequest()
    {
        return $this->belongsTo(DeliveryRequest::class);
    }
}
