<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    public $timestamps = true;
    protected $table = 'rating';
    protected $primaryKey = 'id_rating';
    protected $fillable = ['id_product','rating'];
}
