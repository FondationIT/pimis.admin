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
        Schema::create('valid_das', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('user')->constrained('users');
            $table->foreignId('da')->constrained('dem_aches');
            $table->boolean('resp');
            $table->string('niv');
            $table->string('motif');
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
        Schema::dropIfExists('valid_das');
    }
};
