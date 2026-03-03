<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number')->unique();
            $table->string('name');
            $table->string('course');
            $table->date('date_issued');
            $table->string('status')->default('valid'); // valid / expired / revoked
            $table->timestamps();
        });

        Schema::create('certificate_verification_logs', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->boolean('found')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificate_verification_logs');
        Schema::dropIfExists('certificates');
    }
};
