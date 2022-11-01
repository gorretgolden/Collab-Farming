<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_request_id',
        'actual_no_of_trays',
        'average_weight',
        'total_price',
        'weight1',
        'bulking_center',
        'avg_weight_1',
        'farmer_id'

    ];

   
}
