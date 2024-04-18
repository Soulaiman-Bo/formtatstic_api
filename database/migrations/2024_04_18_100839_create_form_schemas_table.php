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
        Schema::create('form_schemas', function (Blueprint $collection) {
            $collection->id();
            $collection->unsignedBigInteger('form_id');
            $collection->string('type');
            $collection->json('properties');
            $collection->timestamps();
            $collection->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_schemas');
    }
};
