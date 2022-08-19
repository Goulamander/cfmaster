<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RunCostEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'payment_amount',
        'interval',
        'starting_date',
        'numberOfPayment',
    ];
    protected $dates = ['deleted_at','updated_at'];
}
