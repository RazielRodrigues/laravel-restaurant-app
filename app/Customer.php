<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public function myOrders()
    {
        return $this->hasMany('App\Order','customers_id','id');
    }

}
