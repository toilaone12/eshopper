<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    public $timestamps = true;
    protected $table = 'color';
    protected $primaryKey = 'id_color';
    protected $fillable = ['name_color'];
}
