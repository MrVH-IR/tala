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
        Schema::create('gold_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('type', ['BUY', 'SELL']);
            $table->decimal('gold_amount', 14, 3);
            $table->decimal('gold_price', 14, 3);
            $table->decimal('money_amount', 14, 3);
        
            $table->enum('status', [
                'REQUESTED',
                'ADMIN_ACCEPTED',
                'USER_PAID',
                'ADMIN_CONFIRMED',
                'COMPLETED',
                'REJECTED'
            ])->default('REQUESTED');

            $table->foreignId('confirmed_by')->nullable()->references('id')->on('admins');
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gold_orders');
    }
};
