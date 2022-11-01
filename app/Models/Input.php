<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;
    protected $guarded = [];
    const CREATED_AT = 'inputCreated';
    const UPDATED_AT = null;

    public function farmRequests()
    {
        return $this->belongsToMany(FarmRequest::class);
    }
}