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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent')->constrained('agents');
            $table->foreignId('msg_id')->constrained('default_msg');
            $table->string('task');
            $table->boolean('is_read')->default(false);
            $table->boolean('is_delegated')->default(false);
            $table->foreignId('delegated_by')->nullable()->constrained('agents');
            $table->timestamps();
        });

        
        // DB::statement("
        //     ALTER TABLE notifications
        //     ADD CONSTRAINT chk_delegation
        //     CHECK (
        //         (is_delegated = 0 AND delegated_by IS NULL)
        //         OR
        //         (is_delegated = 1 AND delegated_by IS NOT NULL)
        //     )
        // ");

    }
    


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
