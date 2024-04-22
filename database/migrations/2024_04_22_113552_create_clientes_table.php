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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('tipo_de_cliente')->nullable();
            $table->string('RUC')->nullable();
            $table->string('País')->nullable();
            $table->string('Provincia')->nullable();
            $table->string('Dirección')->nullable();
            $table->string('Teléfono')->nullable();
            $table->string('Teléfono_móvil')->nullable();
            $table->string('correo_electrónico')->nullable();
            $table->string('nombre_del_contacto')->nullable();
            $table->string('posición')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
