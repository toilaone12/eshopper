<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatisticNote extends Model
{
    //
    protected $table = 'statistic_note';
    public $timestamps = true;
    protected $primaryKey = 'id_statistic_note';
    protected $fillable = ['quantity_statistic_note','price_statistic_note','date_statistic_note'];
}
