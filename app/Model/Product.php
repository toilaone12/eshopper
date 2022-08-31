<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $timestamps = true;
    protected $table = 'product';
    protected $primaryKey = 'id';

}
