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
        Schema::create('tipo_novedad', function (Blueprint $table) {
            $table->id();
            $table->string('novedad_nombre');
            $table->integer('novedad_horassemestre');
            $table->integer('novedad_horasproceso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_novedad');
    }
};
