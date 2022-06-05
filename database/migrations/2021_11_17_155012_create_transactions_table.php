<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('no_telp');
            $table->string('origin_province');
            $table->string('origin_city');
            $table->string('destination_province');
            $table->string('destination_city');
            $table->string('payment_gateway');
            $table->integer('shipping')->default(0);
            $table->string('service_shipping');
            $table->string('courier');
            $table->string('total_price');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
