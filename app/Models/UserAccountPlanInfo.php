<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class UserAccountPlanInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'current_date',
        'current_account_bal',
        'currentAmazonSaldo',
    ];
    protected $dates = ['deleted_at','updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
