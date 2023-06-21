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
        Schema::create('bitacora_encomiendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_encomienda');
            $table->unsignedBigInteger('id_estado_encomienda');
            $table->datetime('fecha_hora_registro');
            $table->timestamps();
            $table->unsignedBigInteger('created_by_users_id');
            $table->unsignedBigInteger('updated_by_users_id');
            $table->boolean('eliminado')->default(false)->comment("0 no eliminado, 1 eliminado");

            $table->foreign('id_encomienda')->references('id')->on('encomiendas')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_estado_encomienda')->references('id')->on('estados_encomiendas')->onUpdate('no action')->onDelete('no action');
            $table->foreign('created_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('updated_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora_encomiendas');
    }
};
