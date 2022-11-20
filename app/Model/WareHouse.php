<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    //
    protected $table = 'warehouse';
    public $timestamps = true;
    protected $primaryKey = 'id_warehouse';
    protected $fillable = ['id_color','name_product_warehouse','quantity_product_warehouse','price_product_warehouse'];
}
