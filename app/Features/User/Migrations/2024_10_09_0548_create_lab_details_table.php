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
        Schema::create('lab_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lab_id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('street');
            $table->string('post_code');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_details');
    }
};
