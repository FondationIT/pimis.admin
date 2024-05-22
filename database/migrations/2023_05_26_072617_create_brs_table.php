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
        Schema::create('brs', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('bc')->constrained('bcs');
            $table->foreignId('projet')->constrained('projets');
            $table->foreignId('fournisseur')->constrained('fournisseurs');
            $table->string('lieu');
            $table->string('personne');
            $table->string('bordereau');
            $table->string('etat');
            $table->text('comment')->nullable();
            $table->boolean('niv1')->default(false);
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
        Schema::dropIfExists('brs');
    }
};
