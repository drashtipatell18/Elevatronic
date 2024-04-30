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
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id();
            $table->string('foto_de_repuesto')->nullable();
            $table->string('nombre')->nullable();
            $table->string('precio')->nullable();
            $table->longText('descripción')->nullable();
            $table->string('frecuencia_de_limpieza')->nullable()->comment('(días)');
            $table->string('frecuencia_de_lubricación')->nullable()->comment('(días)');
            $table->string('frecuencia_de_ajuste')->nullable()->comment('(días)');
            $table->string('frecuencia_de_revisión')->nullable()->comment('(días)');
            $table->string('frecuencia_de_cambio')->nullable()->comment('(días)');
            $table->string('frecuencia_de_solicitud')->nullable()->comment('(días)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repuestos');
    }
};
