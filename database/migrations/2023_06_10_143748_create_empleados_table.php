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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->unsignedBigInteger('id_tipo_identificacion');
            $table->string('numero_identificacion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('edad')->nullable();
            $table->string('genero')->nullable()->default('Masculino')->comment("Masculino, Femenino, Prefiero no decirlo");
            $table->text('correo')->nullable();
            $table->string('cod_area')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->text('direccion')->nullable();
            $table->unsignedBigInteger('id_turno');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by_users_id');
            $table->unsignedBigInteger('updated_by_users_id');
            $table->boolean('eliminado')->default(false)->comment("0 no eliminado, 1 eliminado");

            $table->foreign('id_tipo_identificacion')->references('id')->on('tipos_identificaciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_turno')->references('id')->on('turnos')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('created_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('updated_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
