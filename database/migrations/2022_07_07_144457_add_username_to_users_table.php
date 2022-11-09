<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//agregar
    {
        Schema::table('users', function (Blueprint $table) {
            //estoy agragando este campo usuario
          $table->string('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //para eliminar
    {
        Schema::table('users', function (Blueprint $table) {
                //(dropColumn)elimina columna
            $table->dropColumn('username')->unique();
        });
    }
};
