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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('fotodeusuario')->nullable();
            $table->string('nombredeusuario')->nullable();
            $table->string('nombre')->nullable();
            $table->string('correo')->nullable();
            $table->string('teléfono')->nullable();
            $table->string('empleado')->nullable();
            $table->string('contraseña')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
