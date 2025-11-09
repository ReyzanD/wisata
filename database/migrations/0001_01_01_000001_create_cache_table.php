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
        Schema::create('cache_232136', function (Blueprint $table) {
            $table->string('key_232136')->primary();
            $table->mediumText('value_232136');
            $table->integer('expiration_232136');
        });

        Schema::create('cache_locks_232136', function (Blueprint $table) {
            $table->string('key_232136')->primary();
            $table->string('owner_232136');
            $table->integer('expiration_232136');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_232136');
        Schema::dropIfExists('cache_locks_232136');
    }
};
