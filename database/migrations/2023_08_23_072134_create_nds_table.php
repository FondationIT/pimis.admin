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
        Schema::create('nds', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('agent')->constrained('users');
            $table->foreignId('projet')->constrained('projets');
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
        Schema::dropIfExists('nds');
    }
};
