<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Add performance indexes for frequently queried columns.
     * These indexes improve query performance for:
     * - Posts: status filtering, date sorting, category lookups
     * - Events: status filtering, date sorting
     * - Galleries: status filtering
     * - PPDB Registrations: status filtering
     */
    public function up(): void
    {
        // Posts indexes
        Schema::table('posts', function (Blueprint $table) {
            $table->index('status', 'posts_status_index');
            $table->index('published_at', 'posts_published_at_index');
            $table->index(['category_id', 'status'], 'posts_category_status_index');
        });

        // Events indexes
        Schema::table('events', function (Blueprint $table) {
            $table->index('status', 'events_status_index');
            $table->index('start_date', 'events_start_date_index');
        });

        // Galleries indexes
        Schema::table('galleries', function (Blueprint $table) {
            $table->index('status', 'galleries_status_index');
        });

        // PPDB Registrations indexes
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->index('status', 'ppdb_registrations_status_index');
            $table->index('ppdb_period_id', 'ppdb_registrations_period_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_status_index');
            $table->dropIndex('posts_published_at_index');
            $table->dropIndex('posts_category_status_index');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex('events_status_index');
            $table->dropIndex('events_start_date_index');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex('galleries_status_index');
        });

        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->dropIndex('ppdb_registrations_status_index');
            $table->dropIndex('ppdb_registrations_period_index');
        });
    }
};
