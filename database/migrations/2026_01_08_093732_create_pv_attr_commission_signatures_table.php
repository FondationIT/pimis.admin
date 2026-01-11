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
        Schema::create('pv_attr_commission_signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pv_attr')->constrained('pv_attrs')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->boolean('niv_1')->default(false);
            $table->boolean('niv_2')->default(false);
            $table->boolean('niv_3')->default(false);

            $table->json('comments')->nullable();

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
        Schema::dropIfExists('pv_attr_commission_signatures');
    }
};
