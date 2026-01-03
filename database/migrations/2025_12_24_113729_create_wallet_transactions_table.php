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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('type', [
                'CREDIT',   // افزایش
                'DEBIT'     // کاهش
            ]);

            $table->decimal('amount', 18, 6);

            $table->string('source_type')->nullable();
            // gold_order, manual_adjustment, refund, etc

            $table->unsignedBigInteger('source_id')->nullable();
            // id مربوط به gold_orders یا هرچی

            $table->text('description')->nullable();

            $table->foreignId('created_by')->nullable()->references('id')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
