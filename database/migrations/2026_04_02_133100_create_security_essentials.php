<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tạo bảng Activity Logs (Sơn móng tay cho Security)
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('user_id')->index();
            $table->string('action');
            $table->string('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('payload')->nullable();
            $table->timestamps();
        });

        // 2. Nâng cấp API Key bảo mật cho Users
        Schema::table('users', function (Blueprint $table) {
            $table->string('api_key_hashed')->nullable()->unique()->after('status');
            $table->timestamp('api_key_last_used_at')->nullable()->after('api_key_hashed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['api_key_hashed', 'api_key_last_used_at']);
        });
    }
};
