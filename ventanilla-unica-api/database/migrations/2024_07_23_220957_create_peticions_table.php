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
        Schema::create('peticions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipopeticions_id');
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->string('mensaje');
            $table->dateTime('fecha_peticion');
            $table->string('vigencia');
            $table->bigInteger('radicado');
            $table->foreignId('user_id');
            $table->foreignId('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peticions');
    }
};
