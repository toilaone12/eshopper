<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    public $timestamps = true;
    protected $primaryKey = 'id_brand';
    protected $table = 'brand';
    protected $fillable = ['logo_brand','name_brand','desc_brand'];
}
