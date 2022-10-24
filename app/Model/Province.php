<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    public $timestamp = true;
    protected $primaryKey = "id_province";
    protected $fillable = ["name_province","type_province"];
    protected $table = "province";
}
