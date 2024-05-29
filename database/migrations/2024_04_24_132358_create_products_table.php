<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('slug', 120);
            $table->string('code', 120);
            $table->integer('initial');
            $table->integer('price');
            $table->integer('stock_quantity');
            $table->text('parameter');
            $table->text('detail');
            $table->tinyInteger('is_featured');
            $table->tinyInteger('is_selling');
            $table->enum('status', ['active', 'inactive', 'out_of_stock']);
            $table->string('created_by', 120)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('product_categories');
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
        Schema::dropIfExists('products');
    }
}
