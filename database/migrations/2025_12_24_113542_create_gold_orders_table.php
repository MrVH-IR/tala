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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            $table->enum('type', ['BUY', 'SELL']);
            
            $table->decimal('amount', 14, 3)->comment('Quantity of asset');
            $table->decimal('price', 14, 3)->comment('Price per unit');
            $table->decimal('total_money', 14, 3)->comment('Total fiat amount');
        
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
        Schema::dropIfExists('orders');
    }
};
