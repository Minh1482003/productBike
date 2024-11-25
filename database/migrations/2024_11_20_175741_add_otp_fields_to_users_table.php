<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('user', function (Blueprint $table) {
            $table->string('otp_code', 6)->nullable();
            $table->timestamp('otp_expired_at')->nullable(); 
            $table->boolean('is_verified')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['otp_code', 'otp_expired_at', 'is_verified']);
        });
    }
};
