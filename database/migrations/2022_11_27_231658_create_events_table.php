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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name', 75);
            $table->string('place', 100);
            $table->text('description');
            $table->unsignedInteger('ticket_stock');
            $table->unsignedInteger('price');
            $table->string('phone', 20);
            $table->string('cover')->nullable();
            $table->string('maps');
            $table->string('query');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
