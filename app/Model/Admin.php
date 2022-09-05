<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    public $timestamps = true;
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
}
