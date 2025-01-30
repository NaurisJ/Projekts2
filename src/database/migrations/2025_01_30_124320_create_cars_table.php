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
            // $table->foreignId('owner_id');
            // $table->foreignId('category_id');
            $table->string('model', 256);
            $table->integer('year');
            $table->string('image', 256)->nullable();
            $table->boolean('on_the_road')->default(true);
            $table->timestamps();

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            // $table->foreign('owner_id')->references('id')->on('owners');
            // $table->foreign('category_id')->references('id')->on('categories');
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
