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
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category_id');
            $table->enum('livestock_type', ["cattle","goats","sheep","pigs","poultry"]);
            $table->text('symptoms');
            $table->text('prevention');
            $table->text('treatment');
            $table->boolean('is_zoonotic')->default(false);
            $table->json('key_symptoms');
            $table->json('secondary_symptoms');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};
