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
        Schema::create('destinations_232136', function (Blueprint $table) {
            $table->id();
            $table->string('name_232136');
            $table->text('description_232136') -> nullable();
            $table->foreignId('category_id_232136')->nullable()->constrained('categories_232136')->onDelete('set null');
            $table->string('location_232136')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations_232136');
    }
};
