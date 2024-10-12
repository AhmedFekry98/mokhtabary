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
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id');
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('street');
            $table->string('post_code');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_details');
    }
};
