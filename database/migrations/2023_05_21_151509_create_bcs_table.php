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
        Schema::create('bcs', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('da')->constrained('dem_aches');
            $table->foreignId('proforma')->constrained('proformas');
            $table->string('personne');
            $table->string('lieu');
            $table->string('delai');
            $table->text('comment')->nullable();
            $table->boolean('niv1')->nullable();
            $table->boolean('niv2')->nullable();
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
        Schema::dropIfExists('bcs');
    }
};
