<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = true;
    protected $table = 'category';
    protected $primaryKey = 'id_category';

}
