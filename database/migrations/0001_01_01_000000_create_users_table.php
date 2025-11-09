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
        Schema::create('users_232136', function (Blueprint $table) {
            $table->id();
            $table->string('name_232136');
            $table->string('email_232136')->unique();
            $table->timestamp('email_verified_at_232136')->nullable();
            $table->string('password_232136');
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens_232136', function (Blueprint $table) {
            $table->string('email_232136')->primary();
            $table->string('token_232136');
            $table->timestamp('created_at_232136')->nullable();
        });

        Schema::create('sessions_232136', function (Blueprint $table) {
            $table->string('id_232136')->primary();
            $table->foreignId('user_id_232136')->nullable()->index();
            $table->string('ip_address_232136', 45)->nullable();
            $table->text('user_agent_232136')->nullable();
            $table->longText('payload_232136');
            $table->integer('last_activity_232136')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
