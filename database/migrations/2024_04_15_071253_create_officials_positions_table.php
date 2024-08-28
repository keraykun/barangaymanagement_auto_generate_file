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
        Schema::create('officials_positions', function (Blueprint $table) {

            $table->foreignId('barangay_id')->constrained('barangays')->cascadeOnDelete();
            $table->foreignId('officials_id')->constrained('officials')->cascadeOnDelete();
            $table->foreignId('positions_id')->constrained('positions')->cascadeOnDelete();
            $table->boolean('unique')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

     // Schema::dropIfExists('officials_positions');

    }
};
