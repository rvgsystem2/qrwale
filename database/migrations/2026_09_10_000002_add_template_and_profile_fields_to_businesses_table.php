<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->foreignId('business_template_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('business_category')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('alternate_mobile', 20)->nullable();
            $table->string('google_map_url', 2048)->nullable();
            $table->string('youtube_url', 2048)->nullable();
            $table->string('gstin', 30)->nullable();
            $table->string('msme_number', 60)->nullable();
            $table->string('opening_hours')->nullable();
        });

        $defaultId = DB::table('business_templates')->where('is_default', true)->value('id');
        if ($defaultId) DB::table('businesses')->whereNull('business_template_id')->update(['business_template_id'=>$defaultId]);
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('business_template_id');
            $table->dropColumn(['tagline','description','business_category','contact_person','alternate_mobile','google_map_url','youtube_url','gstin','msme_number','opening_hours']);
        });
    }
};
