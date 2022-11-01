<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmSupply extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_request_id', 'product_quantity', 'product_type'];

    public function product()
    {
        return $this->belongsTo(Input::class, 'product_type', 'id');
    }

      //a farm supply belongs to a delivery request
      public function delivery_request()
      {
          return $this->belongsTo(DeliveryRequest::class, 'delivery_request_id');
      }
}
