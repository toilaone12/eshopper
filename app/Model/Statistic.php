<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    //
    protected $table = 'statistic';
    public $timestamps = true;
    protected $primaryKey = 'id_statistic';
    protected $fillable = ['quantity_statistic','price_statistic','date_statistic'];
}
