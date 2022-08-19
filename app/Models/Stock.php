<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'current_stock',
        'user_id',
        'product_id'
    ];
    protected $dates = ['deleted_at','updated_at'];
    public static function getStockOfSpecificUser($id = null){
        $result = DB::table('stocks')
        ->select('current_stock')
        ->where('user_id',Auth::user()->id)
        ->where('product_id',$id)
        ->first();
        return $result;
    }
}
