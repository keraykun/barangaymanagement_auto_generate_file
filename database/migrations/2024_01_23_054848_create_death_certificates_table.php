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
        // Schema::create('death_certificates', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('resident_id')->constrained('residents')->cascadeOnDelete();
        //     $table->text('description')->nullable();
        //     $table->string('price');
        //     $table->string('issuance_of');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      //  Schema::dropIfExists('death_certificates');
    }
};
