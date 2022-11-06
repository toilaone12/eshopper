<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    public $timestamp = true;
    protected $table = 'note';
    protected $primaryKey = 'id_note';
    protected $fillable = ['id_supplier','code_note','name_note','quantity_all','status_note'];
}
