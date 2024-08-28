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
        // Schema::create('officials_projects', function (Blueprint $table) {
        //     $table->id();
        //     $table->dropForeign('officials_positions_position_id_foreign');
        //     $table->dropColumn('official_id');
        //     $table->foreignId('barangays_id')->constrained('barangays')->cascadeOnDelete();
        //     $table->foreignId('officials_id')->constrained('officials')->cascadeOnDelete();
        //     $table->foreignId('projects_id')->constrained('projects')->cascadeOnDelete();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     //  Schema::dropIfExists('officials_projects');
    }
};
