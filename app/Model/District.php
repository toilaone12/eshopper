<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    public $timestamp = true;
    protected $table = "district";
    protected $primaryKey = "id_district";
    protected $fillable = ["name_district","type_district","id_province"];
}
