<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    //
    public $timestamp = true;
    protected $primaryKey = "id_commune";
    protected $fillable = ["name_commune","type_commune","id_district"];
    protected $table = "commune";
}

