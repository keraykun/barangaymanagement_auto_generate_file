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
        // Schema::create('projects', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('description');
        //     $table->integer('barangay_id');
        //     $table->string('district');
        //     $table->string('zone');
        //     $table->string('address');
        //     $table->date('start_date_at');
        //     $table->date('end_date_at');
        //     $table->time('start_time_at');
        //     $table->time('end_time_at');
        //     $table->string('active');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      //  Schema::dropIfExists('projects');
    }
};
