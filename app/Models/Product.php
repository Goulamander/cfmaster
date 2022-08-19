<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_name',
        'costs_till_ready_to_sell',
        'payout_per_unit_by',
        'ppc_cost_per_product',
        'deposit_portion',
        'deposit_leadtime',
        'payment_delay_amazon',
        'final_payment_portion',
        'final_payment_leadtime',
        'selling_price_for_sales_tax',
    ];
    protected $dates = ['deleted_at','updated_at'];
    public static function getallproductname(){
        $result = DB::table('products')
        ->select('product_name','id')
        ->where('user_id',Auth::user()->id)
        ->get();
        return $result;
    }
    public static function searchProductName($product_name)
    {
        $result = DB::table('products')
        ->select('product_name','id')
        ->where('user_id',Auth::user()->id)
        ->where('product_name',$product_name)
        ->first();
        return $result;
    }
}
