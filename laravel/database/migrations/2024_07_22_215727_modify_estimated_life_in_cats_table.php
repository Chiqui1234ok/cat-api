<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyEstimatedLifeInCatsTable extends Migration
{
    public function up()
    {
        Schema::table('cats', function (Blueprint $table) {
            // Cambiar el tipo de dato de 'estimatedLife' a integer y permitir que sea nulo
            $table->integer('estimatedLife')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('cats', function (Blueprint $table) {
            // Revertir los cambios si es necesario
            $table->string('estimatedLife')->nullable(false)->change();
        });
    }
}
