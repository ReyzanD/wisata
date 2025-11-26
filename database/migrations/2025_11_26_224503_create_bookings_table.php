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
        Schema::create('bookings_232136', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id_232136')->constrained('users_232136')->onDelete('cascade');
            $table->foreignId('destination_id_232136')->constrained('destinations_232136')->onDelete('cascade');
            $table->string('booking_code_232136')->unique();
            $table->date('visit_date_232136');
            $table->integer('number_of_people_232136');
            $table->text('special_requests_232136')->nullable();
            $table->enum('status_232136', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->decimal('total_price_232136', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings_232136');
    }
};
