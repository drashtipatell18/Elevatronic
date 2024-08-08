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
        Schema::create('assgin_spares', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_del_tipo_de_ascensor')->nullable();
            $table->unsignedBigInteger('repuesto_id')->nullable();
            // Setting up the foreign key constraint
            $table->foreign('repuesto_id')->references('id')->on('repuestos')
                ->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assgin_spares');
    }
};
