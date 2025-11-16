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
        Schema::create('favorites_232136', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_232136');
            $table->unsignedBigInteger('destination_id_232136');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id_232136')->references('id')->on('users_232136')->onDelete('cascade');
            $table->foreign('destination_id_232136')->references('id')->on('destinations_232136')->onDelete('cascade');

            // Prevent duplicate favorites
            $table->unique(['user_id_232136', 'destination_id_232136']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites_232136');
    }
};
