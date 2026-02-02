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
        
        Schema::create('tr_equipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tr')->constrained('trs');
            $table->foreignId('agent')->constrained('agents')->nullable();
            $table->foreignId('agent_ex')->constrained('tdr_external_agents')->nullable();
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
        Schema::dropIfExists('tr_equipe');
    }
};
