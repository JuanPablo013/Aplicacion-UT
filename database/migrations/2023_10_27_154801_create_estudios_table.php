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
        Schema::create('estudios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_docen')->constrained('docentes')->onDelete('cascade');
            $table->foreignId('id_nacad')->constrained('nivel_academico')->onDelete('cascade');
            $table->string('estud_titulo');
            $table->string('estud_universidad');
            // $table->date('estud_fechagrado');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudios');
    }
};
