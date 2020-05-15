<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customerFlow extends Model
{
    protected $fillable = ["customerId",    "idCotizacion",    "sellerId",    "sellerNombre",    "created",    "email",    "name",    "pay_mode",    "creditCardType",    "last4CardDigits",    "externalId",    "status",    "registerDate"];
}
