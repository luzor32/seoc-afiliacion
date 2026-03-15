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
       Schema::create('cargas_familiares', function (Blueprint  $table) {
        $table->id();

        // Relación con afiliado
        $table->unsignedBigInteger('afiliado_id');

        // Datos personales
        $table->string('nombre');
        $table->string('apellido');
        $table->string('dni')->nullable();
        $table->string('parentesco'); // hijo, conyuge, etc
        $table->date('fecha_nacimiento')->nullable();

        // Documentación
        $table->string('foto_dni_frente')->nullable();
        $table->string('foto_dni_dorso')->nullable();
        $table->string('partida_nacimiento')->nullable(); // solo si es hijo
        $table->string('constancia_escolaridad')->nullable(); // solo si es hijo
        $table->string('certificado_discapacidad')->nullable();
        $table->string('acta_matrimonio_convivencia')->nullable(); // solo conyuge

        // Estado de la carga familiar
        $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');

        $table->text('observaciones')->nullable();

        $table->timestamps();

        $table->foreign('afiliado_id')
            ->references('id')
            ->on('afiliados')
            ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas_familiares');
    }
};
