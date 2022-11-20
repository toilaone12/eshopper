<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailImport extends Model
{
    //
    public $timestamp = true;
    protected $table = 'import_note';
    protected $primaryKey = 'id_import';
    protected $fillable = ['id_color','code_note','name_product','quantity_product','price_product'];

}
