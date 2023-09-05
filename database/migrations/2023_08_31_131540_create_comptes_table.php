<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->foreignId('signature')->constrained('users');
            $table->string('intitule')->constrained();
            $table->string('numero')->unique();
            $table->string('type');
            $table->string('proprietaire')->constrained();
            $table->string('banque');
            $table->string('adresse');
            $table->float('solde', 20, 2);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comptes');
    }
};
