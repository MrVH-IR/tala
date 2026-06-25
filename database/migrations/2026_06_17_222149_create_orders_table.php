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
            $table->string('key')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            $table->enum('type', ['BUY', 'SELL']);

            $table->decimal('amount', 36, 18)->comment('Quantity of asset');
            $table->decimal('price', 36, 18)->comment('Price per unit');
            $table->decimal('total_money', 36, 18)->comment('Total fiat amount');

            $table->enum('status', [
                'REQUESTED',
                'PENDING',
                'PAID',
                'REJECTED',
                'CANCELLED',
                'COMPLETED',
            ])->default('REQUESTED');

            $table->foreignId('confirmed_by')->nullable()->constrained('admins')->nullOnDelete();
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
