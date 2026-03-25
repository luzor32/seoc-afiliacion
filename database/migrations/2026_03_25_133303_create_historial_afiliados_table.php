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
        Schema::create('historial_afiliados', function (Blueprint $table) {
            $table->id();

            $table->foreignId('afiliado_id')->constrained()->onDelete('cascade');

            $table->string('estado'); // activo, suspendido, baja, reactivado
            $table->text('observacion')->nullable();

            $table->timestamps(); // 👈 guarda fecha y hora automática
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_afiliados');
    }
};
