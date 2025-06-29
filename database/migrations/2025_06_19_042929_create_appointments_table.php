<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farmer_id'); // Just reference, no FK constraint
            $table->unsignedBigInteger('veterinary_officer_id'); // Just reference, no FK constraint
            $table->dateTime('scheduled_at'); // appointment datetime
            $table->string('status')->default('pending'); // pending, approved, cancelled, completed
            $table->text('notes')->nullable(); // optional notes or purpose
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
