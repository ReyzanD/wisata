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
        Schema::table('galleries_232136', function (Blueprint $table) {
            $table->string('image_232136')->nullable()->after('url_232136');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries_232136', function (Blueprint $table) {
            $table->dropColumn('image_232136');
        });
    }
};
