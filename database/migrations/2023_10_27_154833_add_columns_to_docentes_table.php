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
        Schema::table('docentes', function (Blueprint $table) {
            $table->bigInteger('docen_documento');
            $table->foreignId('docen_lugarexpdoc')->constrained('divipola')->onDelete('cascade');
            $table->string('docen_nombre');
            $table->foreignId('docen_lugarresidencia')->constrained('divipola')->onDelete('cascade');
            $table->string('docen_telefono');
            $table->string('docen_correoinst');
            $table->string('docen_correopersonal');
            $table->foreignId('docen_tipo')->constrained('tipo_docente')->onDelete('cascade');
            $table->foreignId('docen_clasificacionpregrado')->constrained('clasificacion')->onDelete('cascade');
            $table->string('docen_clasificacionpregradoespecial')->nullable();
            $table->string('docen_actaclasificacionpregrado');
            $table->string('docen_fechaclasificacion');
            $table->string('docen_clasificacionposgrado')->nullable();
            $table->text('docen_perfilcompleto')->nullable();
            $table->float('docen_horastotales')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropForeign('docentes_docen_clasificacionpregrado_foreign');
            $table->dropForeign('docentes_docen_lugarexpdoc_foreign');
            $table->dropForeign('docentes_docen_lugarresidencia_foreign');
            $table->dropForeign('docentes_user_id_foreign');
            $table->dropColumn(['docen_documento', 'docen_lugarexpdoc', 'docen_nombre', 'docen_lugarresidencia', 'docen_telefono', 'docen_correoinst', 'docen_correopersonal', 'docen_tipo', 'docen_clasificacionpregrado', 'docen_clasificacionpregradoespecial', 'docen_actaclasificacionpregrado', 'docen_fechaclasificacion', 'docen_clasificacionposgrado', 'docen_perfilcompleto', 'docen_horastotales', 'user_id']);
        });
    }
};
