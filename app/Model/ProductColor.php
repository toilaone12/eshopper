<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    //
    public $timestamp = true;
    protected $table = "product_color";
    protected $primaryKey = "id_product_color";
    protected $fillable = ["id_product","id_color","image_product_color","quantity_product_color"];
}
