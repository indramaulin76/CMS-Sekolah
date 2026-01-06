<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds soft delete capability to critical content tables.
     * This prevents accidental permanent deletion and allows data recovery.
     */
    public function up(): void
    {
        // Posts - Artikel & Berita
        Schema::table('posts', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Events - Agenda/Kegiatan
        Schema::table('events', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Galleries - Album Foto
        Schema::table('galleries', function (Blueprint $table) {
            $table->softDeletes();
        });

        // PPDB Registrations - Data Pendaftaran Siswa Baru
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
