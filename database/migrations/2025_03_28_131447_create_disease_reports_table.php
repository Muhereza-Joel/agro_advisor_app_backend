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
        Schema::create('disease_reports', function (Blueprint $table) {
            $table->id();
            $table->string('farmer_id');
            $table->string('vet_id')->nullable();
            $table->string('disease_id')->nullable();
            $table->enum('livestock_type', ["cattle","goats","sheep","pigs","poultry"]);
            $table->json('symptoms');
            $table->enum('status', ["pending","diagnosed","treated","resolved"]);
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->enum('severity', ["low","medium","high","critical"]);
            $table->string('village_id');
            $table->json('suggested_diseases')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_reports');
    }
};
