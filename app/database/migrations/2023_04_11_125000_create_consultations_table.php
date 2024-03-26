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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            // etat
            $table->dateTime('date_enregistrement');
            $table->dateTime('date_consultation')->nullable();
            $table->text('observation')->nullable();
            $table->text('diagnostic')->nullable();
            $table->text('bilan')->nullable();
            $table->string('type')->nullable();
            $table->string('etat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
