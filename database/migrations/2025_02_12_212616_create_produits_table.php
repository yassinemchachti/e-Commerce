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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('code_barre');
            $table->string('designation');
            $table->double('prix_ht');
            $table->double('tva');
            $table->string('description');
            $table->string('image');
            $table->unsignedBigInteger('sous_famille_id');
            $table->foreign('sous_famille_id')->references('id')->on('sous_familles')->onDelete('cascade');
            $table->unsignedBigInteger('marque_id');
            $table->foreign('marque_id')->references('id')->on('marques')->onDelete('cascade');
            $table->unsignedBigInteger('unite_id');
            $table->foreign('unite_id')->references('id')->on('unites')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
