<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    //
    protected $table = 'slide';
    public $timestamps = true;
    protected $primaryKey = 'id_slide';
    protected $fillable = ['image_slide','name_slide'];
}
