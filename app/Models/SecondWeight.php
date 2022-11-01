<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondWeight extends Model
{
    use HasFactory;

    protected $table = 'second_weights';

    protected $fillable = [
        'delivery_request_id',
        'actual_no_of_trays2',
        'total_price2',
        'weight2',
        'bulking_center',
        'avg_weight_2',
        'current_price',
        'farmer_id'
    ];
}
