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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('bailleur')->constrained('bailleurs');
            $table->string('reference')->unique();
            $table->string('name');
            $table->date('dateD');
            $table->date('dateF')->nullable();
            $table->text('contex')->nullable();
            $table->string('domaine')->nullable();
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
        Schema::dropIfExists('projets');
    }
};
