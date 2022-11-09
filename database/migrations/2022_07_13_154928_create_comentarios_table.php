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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
                                         //(constrained())  determinar el nombre de la tabla y la columna a los que se hace referencia
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //(cascade) al eliminar un usuario se llevara el comentario
            $table->foreignId('post_id')->constrained()->onDelete('cascade');// (cascade) al eliminar un post eliminara el comentario
            $table->string('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
};
