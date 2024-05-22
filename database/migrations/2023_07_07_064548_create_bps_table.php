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
        Schema::create('bps', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('signature')->constrained('users');
            $table->string('bc')->constrained()->onDelete('cascade');
            $table->foreignId('projet')->constrained('projets');
            $table->string('beneficiaire');
            $table->string('type');
            $table->float('montant', 20, 2);
            $table->string('montantTL');
            $table->string('categorie');
            $table->date('dateP');
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
        Schema::dropIfExists('bps');
    }
};
