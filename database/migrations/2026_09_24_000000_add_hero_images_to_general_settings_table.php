<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->json('hero_images')->nullable()->after('hero_image');
        });

        // Keep the existing single hero image working after the new field is added.
        $legacySettings = DB::table('general_settings')
            ->whereNotNull('hero_image')
            ->where('hero_image', '!=', '')
            ->get(['id', 'hero_image']);

        foreach ($legacySettings as $setting) {
            DB::table('general_settings')
                ->where('id', $setting->id)
                ->update([
                    'hero_images' => json_encode([$setting->hero_image]),
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn('hero_images');
        });
    }
};
