<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    public $timestamp = true;
    protected $table = "gallery";
    protected $primaryKey = "id_gallery";
    protected $fillable = ["id_product","name_gallery","image_gallery"];
}
