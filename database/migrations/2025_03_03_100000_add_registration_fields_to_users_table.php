<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('position')->nullable()->after('phone');
            $table->string('organization_name')->nullable()->after('position');
            $table->string('organization_email')->nullable()->after('organization_name');
            $table->string('organization_location')->nullable()->after('organization_email');
            $table->string('organization_phone')->nullable()->after('organization_location');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'position',
                'organization_name',
                'organization_email',
                'organization_location',
                'organization_phone',
            ]);
        });
    }
};
