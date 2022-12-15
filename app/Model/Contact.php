<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public $timestamps = true;
    protected $table = 'contact';
    protected $primaryKey = 'id_contact';
    protected $fillable = ['info_contact','map_contact'];
}
