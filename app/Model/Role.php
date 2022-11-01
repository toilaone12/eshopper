<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';
    public $timestamps = true;
    protected $primaryKey = 'id_role';
    protected $fillable = ['name_role'];
}
