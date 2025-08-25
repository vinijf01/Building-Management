<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->enum('payment_method', ['bank_transfer', 'Qris', 'eMoney']);
            $table->enum('payment_type', ['dp', 'full']);
            $table->enum('payment_status', ['pending_verification', 'verified','rejected','cancelled'])->default('pending_verification');
            $table->decimal('amount',12,2);
            $table->text('remark')->nullable();     
            $table->string('proof_image')->nullable();
            $table->datetime('payment_due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
