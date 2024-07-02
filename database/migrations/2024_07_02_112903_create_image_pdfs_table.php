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
        Schema::create('image_pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('document')->nullable();
            $table->unsignedBigInteger('mant_en_revisións_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('mant_en_revisións_id')->references('id')->on('mant_en_revisións')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_pdfs');
    }
};
