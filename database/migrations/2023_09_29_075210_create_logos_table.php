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
        // Schema::create('logos', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('barangay_id')->constrained('barangays')->cascadeOnDelete();
        //     $table->string('name')->nullable();
        //     $table->string('title');
        //     $table->string('old_name')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      //   Schema::dropIfExists('logos');
    }
};
