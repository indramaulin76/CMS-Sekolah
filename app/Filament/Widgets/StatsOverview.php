<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\PpdbPeriod;
use App\Models\PpdbRegistration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // 1. Article Stats
        $publishedPosts = Post::where('status', 'published')->count();
        $draftPosts = Post::where('status', 'draft')->count();

        // 2. PPDB Pending Stats
        $pendingRegistrations = PpdbRegistration::where('status', 'pending')->count();
        $verifiedRegistrations = PpdbRegistration::where('status', 'verified')->count();

        // 3. PPDB Quota Stats (use scope or direct query with 'status' column)
        $activePeriod = PpdbPeriod::where('status', 'active')->first();
        $quotaStat = Stat::make('PPDB Online', 'Tidak ada gelombang aktif')
            ->description('Silakan buka gelombang baru')
            ->icon('heroicon-o-calendar');

        if ($activePeriod) {
            $totalRegistrations = $activePeriod->registrations()->count(); // Assuming relation exists
            // If relation doesn't exist, we use where('ppdb_period_id', $activePeriod->id)
            $totalRegistrations = PpdbRegistration::where('ppdb_period_id', $activePeriod->id)->count();
            
            $quota = $activePeriod->quota ?? 0;
            $remaining = max(0, $quota - $totalRegistrations);
            
            $quotaStat = Stat::make('Kuota PPDB (' . $activePeriod->name . ')', "$totalRegistrations / $quota Pendaftar")
                ->description("Sisa $remaining kursi tersedia")
                ->descriptionIcon('heroicon-m-chart-pie')
                ->color($remaining < 10 ? 'danger' : 'success')
                ->icon('heroicon-o-user-group');
        }

        return [
            Stat::make('Artikel & Berita', $publishedPosts + $draftPosts)
                ->description("$publishedPosts Terbit, $draftPosts Draft")
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->icon('heroicon-o-newspaper'),

            Stat::make('Pendaftar Baru (Pending)', $pendingRegistrations)
                ->description("$pendingRegistrations perlu verifikasi segera")
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color($pendingRegistrations > 0 ? 'danger' : 'success')
                ->icon('heroicon-o-inbox-arrow-down'),

            $quotaStat,
        ];
    }
}
