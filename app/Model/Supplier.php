<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'supplier';
    public $timestamps = true;
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['name_supplier','address_supplier'];
}
