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
        Schema::create('divipola', function (Blueprint $table) {
            $table->id();
            $table->integer('divip_coddepto');
            $table->integer('divip_codmunicipio');
            $table->string('divip_nomdepto');
            $table->string('divip_nommunicipio');
            $table->string('divip_tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divipola');
    }
};
