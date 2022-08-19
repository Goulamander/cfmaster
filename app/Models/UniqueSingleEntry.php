<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UniqueSingleEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'entry_date',
        'payment_amount',
    ];
    protected $dates = ['deleted_at','updated_at'];
    public static function searchDescription($description)
    {
        $result = DB::table('unique_single_entries')
        ->select('description','id')
        ->where('user_id',Auth::user()->id)
        ->where('description',$description)
        ->first();
        return $result;
    }
}
