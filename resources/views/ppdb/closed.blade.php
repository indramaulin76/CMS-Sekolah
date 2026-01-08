<x-layouts.app :settings="$settings ?? null">
    <x-page-header 
        title="Pendaftaran PPDB" 
        subtitle="Penerimaan Peserta Didik Baru"
        icon="fas fa-user-graduate"
    />

    <div class="container mx-auto px-4 lg:px-8 pb-12">
        <div class="max-w-2xl mx-auto text-center">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-10 border border-gray-200 dark:border-gray-700">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-times text-gray-200 dark:text-gray-700 text-4xl"></i>
                </div>
                
                <h2 class="text-2xl font-bold font-display text-gray-800 dark:text-white mb-4">
                    Pendaftaran Ditutup
                </h2>
                <p class="text-gray-800 dark:text-gray-300 leading-relaxed mb-2">
                    Mohon maaf, saat ini tidak ada periode Pendaftaran Peserta Didik Baru (PPDB) yang sedang aktif atau dibuka.
                </p>
                <p class="text-gray-700 mb-6">
                    Silakan pantau terus website kami untuk informasi jadwal pendaftaran berikutnya.
                </p>
                
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-blue-800 transition-colors">
                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
