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
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->string('first_name')->nullable()->after('uuid');
            $table->string('last_name')->nullable()->after('first_name');
            $table->boolean('is_admin')->default(false)->after('password');
            $table->string('avatar')->nullable()->after('is_admin');
            $table->string('address')->nullable()->after('avatar');
            $table->string('phone_number')->nullable()->after('address');
            $table->boolean('is_marketing')->default(false)->after('phone_number');
            $table->timestamp('last_login_at')->nullable()->after('is_marketing');
            $table->dropColumn('name');
            $table->dropColumn('remember_token');
            $table->dropColumn('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
