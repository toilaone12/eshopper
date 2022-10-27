<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public $timestamps = true;
    protected $table = 'comment';
    protected $primaryKey = 'id_comment';
    protected $fillable = ['id_product','name_comment','comment','reply_comment'];
}
