<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    public $timestamps = true;
    protected $table = "order_detail";
    protected $primaryKey = "id_order_detail";
    protected $fillable = ['id_product','color_product_order','code_order','name_product_order','quantity_product_order','price_product_order'];
}
