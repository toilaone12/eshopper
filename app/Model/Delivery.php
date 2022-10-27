<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    //
    public $timestamp = true;
    protected $primaryKey = "id_feeship";
    protected $fillable = ["province_feeship","district_feeship","commune_feeship","price_feeship"];
    protected $table = "feeship";
}
