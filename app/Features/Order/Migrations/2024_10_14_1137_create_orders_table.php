<?php

use App\Features\Order\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('receiver_id');
            $table->unsignedInteger('branch_id');
            $table->enum('order_type',Order::$orderTypes);
            $table->boolean('visit');
            $table->boolean('delivery');
            $table->enum('status',Order::$statuses)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
