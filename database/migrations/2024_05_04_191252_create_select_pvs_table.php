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
        Schema::create('select_pvs', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('pv')->constrained('pv_attrs');
            $table->string('produit')->constrained('articles');
            $table->foreignId('proforma')->constrained('proformas');
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
        Schema::dropIfExists('select_pvs');
    }
};
