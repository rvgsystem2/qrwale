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
        Schema::table('qr_codes', function (Blueprint $table) {
               // ✅ user_id ko nullable karo (guest QR ke liye)
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // ✅ new columns for guest users
            $table->string('session_id', 100)->nullable()->index();
            $table->text('ip_address')->nullable();
            $table->text('user_agent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('qr_codes', function (Blueprint $table) {
              $table->dropColumn([
                'session_id',
                'ip_address',
                'user_agent'
            ]);
        });
    }
};
