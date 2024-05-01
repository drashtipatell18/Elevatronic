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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('image')->comment('fotodeusuario');
            $table->string('username')->comment('nombredeusuario');
            $table->string('name')->comment('nombre');
            $table->string('email')->comment('correo')->unique();
            $table->string('phone')->comment('teléfono');
            $table->string('employee')->comment('empleado');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('contraseña');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
