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
        Schema::create('pagos_cuotas', function (Blueprint $table) {

            $table->id();

            // Relación con afiliados
            $table->foreignId('afiliado_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Datos del pago
            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');

            // Método de pago
            $table->string('metodo_pago')->nullable();

            // Periodo al que corresponde el pago
            $table->string('periodo'); // ejemplo: 03/2026

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_cuotas');
    }
};
