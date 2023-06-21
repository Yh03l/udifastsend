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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
            $table->unsignedBigInteger('created_by_users_id');
            $table->unsignedBigInteger('updated_by_users_id');
            $table->boolean('visible')->default(true)->comment("0 no visible, 1 visible");
            $table->boolean('eliminado')->default(false)->comment("0 no eliminado, 1 eliminado");

            $table->foreign('created_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('updated_by_users_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
