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
        Schema::create('afiliados', function (Blueprint $table) {

            $table->id();

            // Numero de afiliado
            $table->string('numero_afiliado')->unique();

            // Datos personales
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->string('cuil')->unique();
            $table->string('nacionalidad')->nullable();
            $table->date('fecha_nacimiento')->nullable();

            // Domicilio
            $table->string('provincia')->nullable();
            $table->string('localidad')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('codigo_postal')->nullable();

            // Contacto
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();

            // Datos laborales
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->string('puesto')->nullable();
            $table->string('categoria_laboral')->nullable();
            $table->string('seccion')->nullable();
            $table->string('tipo_contrato')->nullable();
            $table->string('jornada_laboral')->nullable();

            // Datos sindicales
            $table->date('fecha_afiliacion')->nullable();
            $table->string('seccional')->nullable();
            $table->string('delegacion_sindical')->nullable();

            // Baja sindical
            $table->date('fecha_baja')->nullable();
            $table->string('motivo_baja')->nullable();

            // Documentacion
            $table->string('foto_dni_frente')->nullable();
            $table->string('foto_dni_dorso')->nullable();
            $table->string('foto_recibo_sueldo')->nullable();
            $table->string('foto_constancia_laboral')->nullable();

            // Estados
            $table->enum('estado_solicitud', ['pendiente','aprobada','rechazada'])->default('pendiente');
            $table->enum('estado_afiliado', ['activo','inactivo','suspendido','baja'])->default('inactivo');

            // Observaciones
            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Relacion con empresas
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afiliados');
    }
};
