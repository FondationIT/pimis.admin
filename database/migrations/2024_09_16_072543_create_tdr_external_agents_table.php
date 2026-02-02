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
        Schema::create('tdr_external_agents', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('middlename',50)->nullable();
            $table->string('position',100);
            $table->string('organization',100);
            $table->string('contact',100);
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
        Schema::dropIfExists('tdr_external_agents');
    }
};
