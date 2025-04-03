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
        Schema::create('veterinary_officers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('qualification');
            $table->string('specialization')->nullable();
            $table->string('subcounty_id');
            $table->string('license_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veterinary_officers');
    }
};
