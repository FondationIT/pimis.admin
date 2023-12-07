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
        Schema::create('livre_caisses', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('projet')->constrained('projets');
            $table->string('index');
            $table->string('type');
            $table->float('entree', 20, 2);
            $table->float('sortie', 20, 2);
            $table->text('libelle');
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
        Schema::dropIfExists('livre_caisses');
    }
};
