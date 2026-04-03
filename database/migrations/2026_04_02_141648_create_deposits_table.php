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
        Schema::create('deposits', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->index()->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method')->index(); // bank, momo, zalopay, vietqr
            $table->string('transaction_id')->unique()->nullable();
            $table->string('status')->default('completed')->index(); // pending, completed, canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
