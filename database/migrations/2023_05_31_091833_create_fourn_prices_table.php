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
        Schema::create('fourn_prices', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('signature')->constrained('users');
            $table->foreignId('fournisseur')->constrained('fournisseurs');
            $table->string('product')->constrained('articles');
            $table->date('debut');
            $table->date('fin');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('fourn_prices');
    }
};
