<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_flows', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //Datos de Flow
            $table->string('customerId')->nullable();
            $table->string('created')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('pay_mode')->nullable();
            $table->string('creditCardType')->nullable();
            $table->integer('last4CardDigits')->nullable();
            $table->string('externalId')->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('registerDate')->nullable();
            
            //Datos Seller
            $table->string('sellerNombre')->nullable();
            $table->string('sellerId')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_flows');
    }
}
