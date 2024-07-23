<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatsColorsTable extends Migration
{
    public function up()
    {
        Schema::create('cats_colorss', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->constrained('cats')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cats_colorss');
    }
}
