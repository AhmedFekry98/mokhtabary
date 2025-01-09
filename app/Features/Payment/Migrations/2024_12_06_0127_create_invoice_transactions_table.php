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
            $table->unsignedInteger("order_id");
            $table->string("payment_id");
            $table->string("payment_gateway");
            $table->string("transaction_date");
            $table->string("transaction_status");
            $table->string("total_service_charge");
            $table->string("due_value");
            $table->string("paid_currency");
            $table->string("paid_currency_value");
            $table->string("vat_amount");
            $table->string("currency");
            $table->string("error")->nullable();
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
