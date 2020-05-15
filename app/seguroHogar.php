<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seguroHogar extends Model
{
    protected $fillable = ["nombreSeguro","descripcionSeguro","valorSeguro","codigoSeguro","isVisible"];
}
