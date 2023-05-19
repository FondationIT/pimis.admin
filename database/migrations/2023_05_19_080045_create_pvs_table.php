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
        Schema::create('pvs', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('signature')->constrained()->onDelete('cascade');
            $table->string('da')->constrained()->onDelete('cascade');
            $table->string('fournisseur')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->string('dateC');
            $table->string('observation');
            $table->string('justification');
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
        Schema::dropIfExists('pvs');
    }
};
