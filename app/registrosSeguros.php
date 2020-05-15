<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registrosSeguros extends Model
{
    protected $fillable = ["usuarioCotizado","emailCotizado","r7","r8","r9"];
}
