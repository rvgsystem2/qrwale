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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('bussiness_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('website_url')->nullable();
            $table->string('fb_url')->nullable();
            $table->string('insta_url')->nullable();
            $table->string('linkden_url')->nullable();
            $table->string('watsapp_url')->nullable();
            $table->string('twiter_url')->nullable();
            $table->string('review_url')->nullable();
            $table->text('address')->nullable();
            $table->string('rating')->nullable();
            $table->string('logo_img')->nullable();
            $table->string('custum_url')->nullable()->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
