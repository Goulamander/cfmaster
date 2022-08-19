<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateSales extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'demand',
        'incoming',
        'entry_month',
        'entry_year',
        'initial_payment_date',
        'initial_payment_amount',
        'initial_payment_paid',
        'final_payment_date',
        'final_payment_amount',
        'final_payment_paid',
        'fh_payment_amount',
        'sh_payment_amount',
        'fh_payment_date',
        'sh_payment_date',
        'fh_payment_paid',
        'sh_payment_paid',
    ];
    protected $dates = ['deleted_at','updated_at'];
}
