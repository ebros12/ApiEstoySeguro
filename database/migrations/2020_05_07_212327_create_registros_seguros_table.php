<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_seguros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('usuarioCotizado')->nullable();
            $table->string('emailCotizado')->nullable();
            $table->string('r7')->nullable();
            $table->string('r8')->nullable();
            $table->string('r9')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros_seguros');
    }
}
