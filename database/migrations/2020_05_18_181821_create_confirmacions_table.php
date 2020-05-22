<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmacions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('flowOrder')->nullable();
            $table->string('commerceOrder')->nullable();
            $table->string('requestDate')->nullable();
            $table->string('status')->nullable();
            $table->string('subject')->nullable();
            $table->string('currency')->nullable();
            $table->string('amount')->nullable();
            $table->string('payer')->nullable();
            $table->string('optional')->nullable();
            $table->text('pending_info')->nullable();
            $table->text('paymentData')->nullable();
            $table->string('merchantId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confirmacions');
    }
}
