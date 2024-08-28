<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rank');
            $table->boolean('unique')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE officials_positions DROP FOREIGN KEY officials_id');
       Schema::dropIfExists('positions');
        Schema::table('positions', function (Blueprint $table) {
            $table->dropForeign('position_id');
        });
        Schema::dropIfExists('positions');
    }
};
