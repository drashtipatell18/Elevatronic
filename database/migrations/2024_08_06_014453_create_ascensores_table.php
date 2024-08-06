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
        Schema::create('ascensores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('imagen')->nullable();
            $table->string('contrato')->nullable();
            $table->string('nombre')->nullable();
            $table->string('código')->nullable();
            $table->string('marca')->nullable();
            $table->date('fecha')->nullable();
            $table->string('garantizar')->nullable();
            $table->string('dirección')->nullable();
            $table->string('ubigeo')->nullable();
            $table->string('provincia')->nullable();
            $table->string('técnico_instalador')->nullable();
            $table->string('técnico_ajustador')->nullable();
            $table->string('tipo_de_ascensor')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('quarters')->nullable();
            $table->string('npisos')->nullable();
            $table->string('ncontacto')->nullable();
            $table->string('teléfono')->nullable();
            $table->string('correo')->nullable();
            $table->string('descripcion1')->nullable();
            $table->foreign('client_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ascensores');
    }
};
