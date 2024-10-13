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
        Schema::create('radiologyx_rays', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('x_ray_id');
            $table->unsignedInteger('radiology_id');
            $table->float('contract_price');
            $table->float('before_price');
            $table->float('after_price');
            $table->float('offer_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radiologyx_rays');
    }
};
