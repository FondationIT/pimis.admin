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
        Schema::create('liste_paies', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('agent')->constrained('agents');
            $table->foreignId('sAgent')->constrained('statut_agents');
            $table->foreignId('pymt')->constrained('payement_agents');
            $table->foreignId('signature')->constrained('users');
            $table->date('month');

            $table->float('SB', 20, 2);
            $table->integer('jp')->default(22);
            $table->integer('ne');

            $table->boolean('statut')->default(true);
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
        Schema::dropIfExists('liste_paies');
    }
};
