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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('personalfoto')->nullable();
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('posición_id')->nullable(); // Change to unsignedBigInteger
            $table->string('correo')->nullable();
            $table->string('teléfono')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('posición_id')->references('id')->on('positions')->onDelete('set null'); // Adjust 'positions' if the table name is different
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
