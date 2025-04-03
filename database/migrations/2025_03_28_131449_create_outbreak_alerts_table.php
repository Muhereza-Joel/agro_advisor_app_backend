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
        Schema::create('outbreak_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('disease_id');
            $table->string('subcounty_id');
            $table->enum('severity', ["low","medium","high","critical"]);
            $table->text('description');
            $table->text('recommendations');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outbreak_alerts');
    }
};
