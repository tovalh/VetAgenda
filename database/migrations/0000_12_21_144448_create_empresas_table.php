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
            $table->id(); // id automático
            $table->string('nombre'); // Nombre de la empresa
            $table->string('dominio')->unique()->nullable(); // Dominio único para identificar empresas (opcional)
            $table->boolean('estado_suscripcion')->default(true); // Si la empresa está activa
            $table->date('fecha_fin_suscripcion')->nullable(); // Fecha de término de la suscripción
            $table->boolean('habilitado')->default(true); // Si la empresa está habilitada
            $table->json('configuracion')->nullable(); // Configuración personalizada por empresa
            $table->timestamps(); // Campos created_at y updated_at
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
