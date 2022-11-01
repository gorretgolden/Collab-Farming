<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_request_id',
        'total_price2',
        'status',
        'farmer_status',
        'farmer_id'

    ];
}
