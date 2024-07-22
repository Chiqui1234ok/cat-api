<?php

// database/migrations/xxxx_xx_xx_modify_cats_table.php
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
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn('colorcast');
            // $table->string('breed')->nullable();
            $table->string('breed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->string('colorcast');
            $table->dropColumn('breed');
        });
    }
};
