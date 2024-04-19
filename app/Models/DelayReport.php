<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DelayReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'order_id',
        'estimate_delivery_time',
        'request_date',
    ];
}
