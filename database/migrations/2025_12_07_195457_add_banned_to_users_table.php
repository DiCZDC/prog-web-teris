<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Support;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('banned')->default(false)->after('email_verified_at');
            $table->timestamp('banned_at')->nullable()->after('banned');
            $table->text('banned_reason')->nullable()->after('banned_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['banned', 'banned_at', 'banned_reason']);
        });
    }
};