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
        Schema::create('decharges', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('projet')->constrained('projets');
            $table->foreignId('bp')->constrained('bps');
            $table->string('beneficiare');
            $table->string('qualite');
            $table->string('piece');
            $table->string('phone');
            $table->string('institution');
            $table->float('montant', 20, 2);
            $table->string('montantTL');
            $table->string('motif');
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
        Schema::dropIfExists('decharges');
    }
};
