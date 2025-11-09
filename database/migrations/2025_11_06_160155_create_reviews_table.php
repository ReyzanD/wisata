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
        Schema::create('reviews_232136', function (Blueprint $table) {
            $table->id();
            $table->string('user_name_232136');
            $table->foreignId('user_id_232136')->nullable()->constrained('users_232136')->onDelete('cascade');
            $table->foreignId('destination_id_232136')->constrained('destinations_232136')->onDelete('cascade');
            $table->integer('rating_232136');
            $table->text('comment_232136')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews_232136');
    }
};
