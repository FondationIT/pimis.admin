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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->string('service');
            $table->string('gender')->nullable();
            $table->string('etatcivil')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('lieu')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->string('adress')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('agents');
    }
};
