<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <div class="mb-8">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-times text-gray-400 text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold font-display text-gray-800 dark:text-white mb-4">
                    Pendaftaran Ditutup
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                    Mohon maaf, saat ini tidak ada periode Pendaftaran Peserta Didik Baru (PPDB) yang sedang aktif atau dibuka.
                </p>
                <p class="text-gray-500 mt-2">
                    Silakan pantau terus website kami untuk informasi jadwal pendaftaran berikutnya.
                </p>
            </div>
            
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark transition-colors">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</x-layouts.app>
