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
        Schema::table('advisories', function (Blueprint $table) {
            // Rename 'user_id' to 'vet_id'
            $table->renameColumn('vet_id', 'user_id');

            // Update the foreign key constraint
            $table->dropForeign(['vet_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advisories', function (Blueprint $table) {
            $table->renameColumn('user_id', 'vet_id');
            $table->dropForeign(['user_id']);
            $table->foreign('vet_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
