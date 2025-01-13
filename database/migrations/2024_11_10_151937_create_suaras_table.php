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
        Schema::create('suaras', function (Blueprint $table) {
            $table->id();
            $table->integer('suara_darwis');
            $table->integer('suara_baharuddin');
            $table->integer('suara_zahir');
            $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
            $table->unsignedBigInteger('tps_id');
            $table->unsignedBigInteger('user_id');
            $table->string('form_c1');
            $table->timestamps();

            // Tambahkan foreign key jika relasi dibutuhkan
            $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suaras');
    }
};
