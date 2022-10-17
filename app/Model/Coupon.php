<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    public $timestamps = true;
    protected $table = "coupon";
    protected $primaryKey = "id_coupon";
    protected $fillable = ['name_coupon','code_coupon','quantity_coupon','feature_coupon','discount_coupon'];
}
