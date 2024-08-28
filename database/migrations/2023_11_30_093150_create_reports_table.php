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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained('barangays')->cascadeOnDelete();
            $table->unsignedBigInteger('resident_id')->nullable();
            $table->string('resident_name')->nullable();
            $table->string('name')->nullable();
            $table->mediumText('statements')->nullable();
            $table->longText('actions')->nullable();
            $table->string('involved');
            $table->string('location');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('district_name')->nullable();
            $table->boolean('remark')->default(1);
            $table->date('date_reported');
            $table->date('date_incident');
            $table->date('date_recorded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
