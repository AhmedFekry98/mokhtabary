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
        Schema::create('invoice_transactions', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_id");
            $table->unsignedInteger("order_id");
            $table->string("payment_method");
            $table->string("date_operation");
            $table->string("transaction_status");
            $table->string("invoice_value_in_base_currency");
            $table->string("base_currency");
            $table->string("invoice_value_in_pay_currency");
            $table->string("pay_currency");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_transactions');
    }
};
