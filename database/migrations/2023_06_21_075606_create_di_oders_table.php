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
        Schema::create('di_oders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('product')->constrained()->onDelete('cascade');
            $table->string('di')->constrained()->onDelete('cascade');
            $table->integer('quantite');
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
        Schema::dropIfExists('di_oders');
    }
};
