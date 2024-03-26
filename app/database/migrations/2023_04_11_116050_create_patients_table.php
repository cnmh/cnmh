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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tuteur_id');
            $table->unsignedBigInteger('niveau_scolaire_id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->nullable();
            $table->string('cin')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('adresse')->nullable();
            $table->text('remarques')->nullable();
            $table->foreign('tuteur_id')->references('id')->on('tuteurs');
            $table->foreign('niveau_scolaire_id')->references('id')->on('niveau_scolaires');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
