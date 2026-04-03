<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            // Tối ưu hóa Database (Senior Hardcore Indexing)
            $table->index(['user_id', 'action', 'created_at'], 'idx_user_activity_search');
            $table->index('ip_address');
        });
    }

    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropIndex('idx_user_activity_search');
            $table->dropIndex(['ip_address']);
        });
    }
};
