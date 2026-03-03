<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('bookable_type'); // Training or Workshop
            $table->unsignedBigInteger('bookable_id');
            $table->decimal('amount', 12, 2);
            $table->string('mpesa_phone', 20)->nullable();
            $table->string('mpesa_checkout_request_id')->nullable();
            $table->string('mpesa_merchant_request_id')->nullable();
            $table->string('mpesa_reference')->nullable();
            $table->string('mpesa_result_code')->nullable();
            $table->string('mpesa_result_desc')->nullable();
            $table->string('status', 20)->default('pending'); // pending, paid, failed, cancelled
            $table->timestamps();

            $table->index(['bookable_type', 'bookable_id']);
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
