<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $timestamps = true;
    protected $table = "order";
    protected $primaryKey = "id_order";
    protected $fillable = ['code_order','name_customer','phone_order','address_order','email_order','name_payment','total_order','type_shipping','coupon_order','fee_delivery','status_order'];
}
