<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryRequest;

class BulkingCenter extends Model
{
    use HasFactory;
    protected $guarded =[];
    const CREATED_AT = 'centerCreated';
    const UPDATED_AT = null;


     //a bulking center has many delivery requests
     public function delivery_requests()
     {
         return $this->hasMany(DeliveryRequest::class, 'bulking_center');
     }
}
