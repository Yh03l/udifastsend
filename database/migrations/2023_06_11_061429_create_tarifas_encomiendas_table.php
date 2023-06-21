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
        Schema::create('tarifas_encomiendas', function (Blueprint $table) {
            $table->id();
            $table->decimal('peso_maximo', 12, 2)->nullable();
            $table->decimal('precio_base', 8, 2);
            $table->unsignedBigInteger('id_tipo_envio');
            $table->unsignedBigInteger('id_tipo_encomienda');
            $table->unsignedBigInteger('id_sucursal_origen');
            $table->unsignedBigInteger('id_sucursal_destino');
            $table->timestamps();
            $table->unsignedBigInteger('created_by_users_id');
            $table->unsignedBigInteger('updated_by_users_id');
            $table->boolean('visible')->default(true)->comment("0 no visible, 1 visible");
            $table->boolean('eliminado')->default(false)->comment("0 no eliminado, 1 eliminado");

            $table->foreign('id_tipo_envio')->references('id')->on('tipos_envios')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_tipo_encomienda')->references('id')->on('tipos_encomiendas')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_sucursal_origen')->references('id')->on('sucursales')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_sucursal_destino')->references('id')->on('sucursales')->onUpdate('no action')->onDelete('no action');
            $table->foreign('created_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('updated_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifas_encomiendas');
    }
};
