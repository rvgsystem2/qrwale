<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('layout', ['split', 'centered', 'banner'])->default('split');
            $table->string('primary_color', 7)->default('#991b1b');
            $table->string('secondary_color', 7)->default('#0f172a');
            $table->string('accent_color', 7)->default('#f59e0b');
            $table->string('background_color', 7)->default('#fff7ed');
            $table->enum('card_style', ['soft', 'bordered', 'glass'])->default('soft');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        DB::table('business_templates')->insert([
            ['name'=>'Classic Premium','slug'=>'classic-premium','layout'=>'split','primary_color'=>'#991b1b','secondary_color'=>'#0f172a','accent_color'=>'#f59e0b','background_color'=>'#fff7ed','card_style'=>'glass','is_active'=>1,'is_default'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Modern Clean','slug'=>'modern-clean','layout'=>'centered','primary_color'=>'#2563eb','secondary_color'=>'#0f172a','accent_color'=>'#22c55e','background_color'=>'#eff6ff','card_style'=>'soft','is_active'=>1,'is_default'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Luxury Dark','slug'=>'luxury-dark','layout'=>'banner','primary_color'=>'#18181b','secondary_color'=>'#000000','accent_color'=>'#d4af37','background_color'=>'#09090b','card_style'=>'bordered','is_active'=>1,'is_default'=>0,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }

    public function down(): void { Schema::dropIfExists('business_templates'); }
};

