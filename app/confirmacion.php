<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class confirmacion extends Model
{
    protected $fillable = ['flowOrder'
    ,'commerceOrder'
    ,'requestDate'
    ,'status'
    ,'subject'
    ,'currency'
    ,'amount'
    ,'payer'
    ,'optional'
    ,'pending_info'
    ,'paymentData'
    ,'merchantId'];
}
