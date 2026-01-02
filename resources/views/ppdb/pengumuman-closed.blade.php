<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-2xl p-10">
                <div class="w-20 h-20 bg-yellow-100 dark:bg-yellow-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clock text-yellow-600 dark:text-yellow-400 text-4xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold font-display text-gray-800 dark:text-white mb-4">
                    Pengumuman Belum Tersedia
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Saat ini belum ada pengumuman hasil PPDB yang dipublikasikan. 
                    Silakan cek kembali setelah tanggal pengumuman resmi.
                </p>
                
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-blue-800 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
