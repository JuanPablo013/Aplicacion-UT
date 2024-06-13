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
        Schema::create('novedades', function (Blueprint $table) {
            $table->id();
            $table->string('novedad_tipo');
            $table->foreignId('novedad_codigoprograma')->constrained('programas')->onDelete('cascade');
            $table->foreignId('novedad_docente')->constrained('docentes')->onDelete('cascade');
            $table->foreignId('novedad_codigocat')->constrained('cat')->onDelete('cascade');
            $table->string('novedad_semestre');
            $table->string('novedad_grupo');
            $table->string('novedad_codigoasignatura');
            $table->string('novedad_nombreasignatura');
            $table->integer('novedad_horas');
            $table->float('novedad_horasfactor')->nullable();
            $table->string('novedad_numeroestudiantes');
            $table->string('novedad_desplazamiento')->nullable();
            $table->string('novedad_numerodesplazamiento')->nullable();
            $table->text('novedad_observacion')->nullable();
            $table->date('novedad_fechainicio');
            $table->date('novedad_fechafin');
            $table->string('novedad_soportes');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novedades');
    }
};
