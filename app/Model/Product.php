<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $timestamps = true;
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = ['id_brand','id_category','name_product','image_product',
    'price_product','quantity_product','description_product'];
}
