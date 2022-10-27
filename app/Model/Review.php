<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public $timestamps = true;
    protected $table = 'review';
    protected $primaryKey = 'id_review';
    protected $fillable = ['id_product','name_review','content_review','rating'];
}
