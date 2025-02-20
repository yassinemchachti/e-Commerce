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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('heure');
            $table->boolean('regle');
            $table->unsignedBigInteger('mode_reglement_id');
            $table->foreign('mode_reglement_id')->references('id')->on('mode_reglements')->onDelete('cascade');
            $table->unsignedBigInteger('etat_id');
            $table->foreign('etat_id')->references('id')->on('etats')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
