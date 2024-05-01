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
        Schema::create('mant_en_revisións', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_de_revisión')->nullable();
            $table->string('ascensor')->nullable();
            $table->string('dirección')->nullable();
            $table->string('provincia')->nullable();
            $table->string('núm_certificado')->nullable();
            $table->string('máquina')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('técnico')->nullable();
            $table->string('mes_programado')->nullable();
            $table->date('fecha_de_mantenimiento')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->longText('observaciónes')->nullable();
            $table->longText('observaciónes_internas')->nullable();
            $table->longText('solución')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mant_en_revisións');
    }
};
