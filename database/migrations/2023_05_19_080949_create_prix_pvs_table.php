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
        Schema::create('prix_pvs', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('signature')->constrained()->onDelete('cascade');
            $table->string('pv')->constrained()->onDelete('cascade');
            $table->string('produit')->constrained()->onDelete('cascade');
            $table->string('proforma')->constrained()->onDelete('cascade');
            $table->float('prix');
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
        Schema::dropIfExists('prix_pvs');
    }
};
