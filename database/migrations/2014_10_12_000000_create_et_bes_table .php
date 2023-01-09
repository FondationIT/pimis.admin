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
        Schema::create('et_bes', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->string('agent')->constrained()->onDelete('cascade');
            $table->string('ligne')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('niv1')->default(false);
            $table->boolean('niv2')->default(false);
            $table->boolean('niv3')->default(false);
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
        Schema::dropIfExists('et_bes');
    }
};
