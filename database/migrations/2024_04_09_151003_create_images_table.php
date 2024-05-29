<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('src', 120);
            $table->integer('size');
            $table->string('created_by', 120)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *00
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
