<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCardDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'qr',
        'printed_on',
        'expiry_on',
        'last_scanned',
        'status'
    ];
}
// Schema::create('agent_card_details', function (Blueprint $table) {
//             $table->id();
//             $table->string('barcode',18);
//             $table->string('qr')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
//             $table->timestamp('printed_on');
//             $table->string('expiry_on')->default('fin contract');
//             $table->timestamp('last_scanned');
//             $table->timestamp('status');
//             $table->timestamps();

//             // Foreign key to agents.matricule
//             $table->foreign('qr')
//                   ->references('matricule')
//                   ->on('agents')
//                   ->onDelete('cascade');
//         });

//         Schema::create('agent_card_daily_scans', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('card')->constrained('agent_card_details')
//                   ->cascadeOnDelete()
//                   ->cascadeOnUpdate();
//             $table->enum('scan_type',['qrcode','barcode']);
//             $table->timestamps();
//         });