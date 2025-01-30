<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manufacturer_id');
            $table->foreignId('type_id');
            $table->string('model', 256);
            $table->integer('year');
            $table->string('image', 256)->nullable();
            $table->boolean('on_the_road')->default(true);
            $table->timestamps();

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            $table->foreign('type_id')->references('id')->on('types');
            // $table->foreign('car_id')->references('id')->on('cars');
            // $table->foreign('type_id')->references('id')->on('type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
