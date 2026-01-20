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
        Schema::create('pv_commissioners_concent_rejects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pv_commission_id')->constrained('pv_commissioners_concents')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->foreignId('changed_by')->constrained('agents')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
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
        Schema::dropIfExists('pv_commissioners_concent_rejects');
    }
};
