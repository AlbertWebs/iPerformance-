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
        Schema::create('hero_section', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->nullable();
            $table->string('headline')->nullable();
            $table->string('headline_highlight')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('cta_1_text')->nullable();
            $table->string('cta_1_url')->nullable();
            $table->string('cta_2_text')->nullable();
            $table->string('cta_2_url')->nullable();
            $table->string('cta_3_text')->nullable();
            $table->string('cta_3_url')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_section');
    }
};
