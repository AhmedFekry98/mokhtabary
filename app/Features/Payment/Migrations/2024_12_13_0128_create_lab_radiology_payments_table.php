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
        Schema::create('lab_radiology_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receiver_id');
            $table->float('total_amount_order'); // all amount order
            $table->float('total_amount_mokhtabary'); // all amount for mokhtabary
            $table->float('vat_precentage');
            $table->float('vat_amount');
            $table->float('amount_after_vat');
// for receiver
            $table->float('total_amount_receiver'); // all amount for receiver lab or radiology
            $table->float('tax_percentage'); // tax for lab or radiology
            $table->float('tax_amount');
            $table->float('amunt_after_taxes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_radiology_payments');
    }
};
