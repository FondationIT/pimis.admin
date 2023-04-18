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
        Schema::create('bailleurs', function (Blueprint $table) {
            $table->id();
            $table->string('signature')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->float('min1', 20, 2);
            $table->float('min2', 20, 2);
            $table->float('min3', 20, 2);
            $table->float('max1', 20, 2);
            $table->float('max2', 20, 2);
            $table->float('max', 20, 2);
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
        Schema::dropIfExists('bailleurs');
    }
};
