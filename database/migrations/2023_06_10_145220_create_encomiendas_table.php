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
        Schema::create('encomiendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sucursal_origen');
            $table->unsignedBigInteger('id_sucursal_destino');
            $table->unsignedBigInteger('id_cliente_remitente');
            $table->unsignedBigInteger('id_cliente_destinatario');
            $table->datetime('fecha_hora_recepcion');
            $table->unsignedBigInteger('id_empleado_recepcionista');
            $table->datetime('fecha_hora_entrega')->nullable();
            $table->unsignedBigInteger('id_empleado_despachante')->nullable();
            $table->text('observaciones');
            $table->unsignedBigInteger('id_tipo_envio');
            $table->decimal('tarifa_total_envio', 12, 2);
            $table->boolean('pagado')->default(false)->comment("0 pendiente, 1 pagado");
            $table->timestamps();
            $table->unsignedBigInteger('created_by_users_id');
            $table->unsignedBigInteger('updated_by_users_id');
            $table->boolean('eliminado')->default(false)->comment("0 no eliminado, 1 eliminado");

            $table->foreign('id_cliente_remitente')->references('id')->on('clientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_cliente_destinatario')->references('id')->on('clientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_empleado_recepcionista')->references('id')->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_empleado_despachante')->references('id')->on('empleados')->onUpdate('no action')->onDelete('no action');
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
        Schema::dropIfExists('encomiendas');
    }
};
