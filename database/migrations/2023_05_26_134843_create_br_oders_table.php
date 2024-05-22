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
        Schema::create('br_oders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('br')->constrained('brs');
            $table->foreignId('bc')->constrained('bcs');
            $table->foreignId('produit')->constrained('articles');
            $table->integer('quantite');
            $table->text('observation');
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
        Schema::dropIfExists('br_oders');
    }
};
