<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suscripcion extends Model
{
    protected $fillable = ["subscriptionId"
    ,"planId"
    ,"plan_name"
    ,"customerId"
    ,"created"
    ,"subscription_start"
    ,"Estado"
    ,"EstadoID"
    ,"flowOrder"];

}
