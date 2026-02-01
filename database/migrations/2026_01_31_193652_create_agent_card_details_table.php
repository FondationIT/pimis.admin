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
        // number,agent,created,expiry,kwargs
        Schema::create('agent_card_details', function (Blueprint $table) {
            $table->id();
            $table->string('barcode',18);
            $table->string('qr')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->timestamp('printed_on');
            $table->string('expiry_on')->default('fin contract');
            $table->timestamp('last_scanned');
            $table->enum('status',['active','lost','sleep','expired']);
            $table->timestamps();

            // Foreign key to agents.matricule
            $table->foreign('qr')
                  ->references('matricule')
                  ->on('agents')
                  ->onDelete('cascade');
        });

        Schema::create('agent_card_daily_scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card')->constrained('agent_card_details')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->enum('scan_type',['qrcode','barcode']);
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
        Schema::dropIfExists('agent_card_details');
        Schema::dropIfExists('agent_card_daily_scans');
    }
};
