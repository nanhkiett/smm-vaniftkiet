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
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->index()->constrained()->onDelete('cascade');
            $table->foreignUlid('service_id')->index();
            $table->integer('quantity');
            $table->decimal('charge', 15, 2)->default(0);
            $table->integer('start_count')->nullable();
            $table->integer('remains')->nullable();
            $table->string('status')->default('pending')->index(); // pending, processing, completed, partial, refunded, canceled
            $table->string('api_order_id')->nullable();
            $table->string('provider_id')->nullable();
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
