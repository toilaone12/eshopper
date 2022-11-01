<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    public $timestamps = true;
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    public function getAuthPassword()
    {
        return $this->password_admin;
    }
    public function hasRole($role){
        return null !== Admin::where('id_role',$role)->first();
    }
}
