<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColorsColumnInCatsTable extends Migration
{
    public function up()
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->json('colors')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->json('colors')->nullable(false)->change();
        });
    }
}
