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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('ascensor')->nullable();
            $table->string('fecha_de_propuesta')->nullable();
            $table->string('monto_de_propuesta')->nullable();
            $table->string('monto_de_contrato')->nullable();
            $table->string('fecha_de_inicio')->nullable();
            $table->string('fecha_de_fin')->nullable();
            $table->string('renovación')->nullable();
            $table->string('cada_cuantos_meses')->nullable();
            $table->string('observación')->nullable();
            $table->string('estado_cuenta_del_contrato')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
