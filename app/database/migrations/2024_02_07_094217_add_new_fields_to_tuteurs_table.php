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
        Schema::table('tuteurs', function (Blueprint $table) {
            $table->string('professionPere')->nullable();
            $table->string('professionMere')->nullable();
            $table->integer('nombreDesEnfants')->nullable();
            $table->string('lienParente')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tuteurs', function (Blueprint $table) {
            //
        });
    }
};
