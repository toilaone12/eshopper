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
    'price_product','quantity_sold_product','description_product','content_product','number_reviews','number_views'];

     public function productColor(){
        return $this->hasMany(ProductColor::class,'id_product','id');
    }
}
