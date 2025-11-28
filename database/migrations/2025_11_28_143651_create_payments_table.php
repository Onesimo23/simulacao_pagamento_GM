<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['M-PESA', 'EMOLA', 'VISA']);
            $table->string('payment_detail')->nullable();
            $table->enum('status', ['SUCCESS', 'FAILED', 'PENDING'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
