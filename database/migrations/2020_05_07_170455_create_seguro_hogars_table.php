<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguroHogarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguro_hogars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombreSeguro')->unique();
            $table->string('descripcionSeguro')->nullable();
            $table->string('valorSeguro')->nullable();
            $table->string('codigoSeguro')->nullable();
            $table->boolean('isVisible')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguro_hogars');
    }
}
