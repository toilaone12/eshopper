<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customer';
    protected $fillable = ['image_customer','name_customer',
                            'age_customer','sex_customer',
                            'email_customer','phone_customer',
                            'address_customer','password_customer','vip_customer'];
    protected $primaryKey = 'id_customer';
    public $timestamps = true;
}
