<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained()->onDelete('cascade');
            $table->foreignId('veterinary_officer_id')->constrained('users')->onDelete('cascade'); // user with chairperson role
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
