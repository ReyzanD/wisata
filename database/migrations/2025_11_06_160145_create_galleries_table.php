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
        Schema::create('galleries_232136', function (Blueprint $table) {
            $table->id();
            $table->string('title_232136');
            $table->string('url_232136');
            $table->foreignId('destination_id_232136')->constrained('destinations_232136')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries_232136');
    }
};
