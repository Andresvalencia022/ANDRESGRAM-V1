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
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('imagen'); //para el nombre de la imagen
                                       //(constrained())  determinar el nombre de la tabla y la columna a los que se hace referencia
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //(onDelete() quiere decir eliminar )al eliminar el ususario se llevara sus post
            $table->timestamps(); //marca de tiempo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
