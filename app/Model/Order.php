<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $timestamps = true;
    protected $table = "order";
    protected $primaryKey = "id_order";
    protected $fillable = ['code_order','name_customer','name_payment','total_order','status_order'];
}
