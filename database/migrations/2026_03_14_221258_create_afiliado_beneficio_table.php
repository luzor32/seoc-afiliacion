<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('afiliado_beneficio', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('afiliado_id');
            $table->unsignedBigInteger('beneficio_id');

            $table->timestamps();

            $table->foreign('afiliado_id')->references('id')->on('afiliados')->onDelete('cascade');
            $table->foreign('beneficio_id')->references('id')->on('beneficios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('afiliado_beneficio');
    }
};
