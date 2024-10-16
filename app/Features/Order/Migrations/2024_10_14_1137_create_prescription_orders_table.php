<?php

use App\Features\Order\Models\PrescriptionOrder;
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
        Schema::create('prescription_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('family_detail_id')->nullable();
            $table->unsignedInteger('receiver_id');
            $table->enum('order_type',PrescriptionOrder::$orderTypes);
            $table->enum('status',PrescriptionOrder::$statuses)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_orders');
    }
};
