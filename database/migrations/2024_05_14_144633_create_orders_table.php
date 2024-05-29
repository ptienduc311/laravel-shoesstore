<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code', 120)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('total_amout')->nullable();
            $table->timestamp('order_date')->nullable();
            $table->enum('payment', ['COD', 'Online'])->nullable();
            $table->string('address', 120)->nullable();
            $table->enum('status', ['pending', 'processing', 'shipping', 'delivered', 'canceled'])->nullable()->default('pending');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('orders');
    }
}
