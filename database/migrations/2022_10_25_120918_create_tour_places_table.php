<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_places', function (Blueprint $table) {
            $table->integer('id', false)->primary();
            $table->string('name');
            $table->string('city', 50);
            $table->string('address');
            $table->text('description');
            $table->unsignedSmallInteger('ticket_stock');
            $table->unsignedInteger('price');
            $table->string('telp');
            $table->string('image',)->default('default.jpg');
            $table->string('image_id',)->nullable();
            $table->string('maps', 75);
            $table->string('query', 75)->nullable();
            $table->boolean('rental')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_places');
    }
};
