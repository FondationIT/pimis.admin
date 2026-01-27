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
        Schema::create('pv_commissioners_concents', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('agent')->constrained('agents')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->foreignId('pv')->constrained('pvs')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->string('is_approved',20)->default('En attente');
            $table->text('comment');

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
        Schema::dropIfExists('pv_commissioners_concents');
    }
};
