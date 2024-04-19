<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentDelayReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'agent_id',
        'delay_report_id',
        'status',
        'description',
    ];
}
