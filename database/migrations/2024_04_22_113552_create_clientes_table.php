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
            $table->string('ruc')->nullable();
            $table->string('país')->nullable();
            $table->string('provincia')->nullable();
            $table->string('dirección')->nullable();
            $table->string('teléfono')->nullable();
            $table->string('teléfono_móvil')->nullable();
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
