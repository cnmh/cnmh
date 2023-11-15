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
        Schema::create('orientation_externes', function (Blueprint $table) {

            $table->id();
            $table->foreignId('dossier_patient_id')->constrained('dossier_patients');
            $table->foreignId('service_id')->constrained('services');
            $table->string('objet');
            $table->text('description');
            $table->date("date_orientation");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orientation_externes');
    }
};
