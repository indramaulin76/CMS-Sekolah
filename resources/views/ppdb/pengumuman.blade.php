<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-5xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-10">
                <span class="inline-block px-4 py-2 mb-4 text-xs font-bold tracking-wider text-primary uppercase bg-secondary rounded-full shadow">
                    Tahun Ajaran {{ $period->academic_year }}
                </span>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white font-display mb-4">
                    <i class="fas fa-bullhorn text-secondary mr-2"></i>
                    Pengumuman Hasil PPDB
                </h1>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Berikut adalah daftar calon peserta didik baru yang <strong class="text-green-600">DITERIMA</strong> di SMA Tunas Harapan.
                </p>
            </div>

            {{-- Period Info --}}
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-8 mb-8 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-gray-200 dark:divide-gray-700">
                    <div class="py-2 md:py-0">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1 font-medium uppercase tracking-wide">Periode</div>
                        <div class="font-bold text-xl text-gray-800 dark:text-white">{{ $period->name }}</div>
                    </div>
                    <div class="py-2 md:py-0">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1 font-medium uppercase tracking-wide">Total Diterima</div>
                        <div class="font-bold text-4xl text-yellow-500">{{ $acceptedRegistrations->count() }}</div>
                    </div>
                    <div class="py-2 md:py-0">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1 font-medium uppercase tracking-wide">Tanggal Pengumuman</div>
                        <div class="font-bold text-xl text-gray-800 dark:text-white">{{ $period->announcement_date?->format('d F Y') ?? '-' }}</div>
                    </div>
                </div>
            </div>

            @if($acceptedRegistrations->isEmpty())
            {{-- No Results --}}
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-10 text-center">
                <i class="fas fa-info-circle text-yellow-500 text-5xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Belum Ada Pengumuman</h3>
                <p class="text-gray-600 dark:text-gray-400">Daftar peserta yang diterima belum tersedia. Silakan cek kembali nanti.</p>
            </div>
            @else
            {{-- Search Box --}}
            <div class="mb-6">
                <div class="relative max-w-4xl mx-auto">
                    <input type="text" id="search-input" placeholder="Cari berdasarkan nama atau NISN..." 
                           class="w-full px-5 py-4 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent shadow-sm">
                </div>
            </div>

            {{-- Results Table --}}
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="w-full" id="results-table">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Kode Pendaftaran</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Nama Lengkap</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">NISN</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Asal Sekolah</th>
                                <th class="px-6 py-4 text-center text-sm font-bold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($acceptedRegistrations as $index => $reg)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors result-row">
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $index + 1 }}</td>
                                <td class="px-4 py-4 text-sm font-mono font-bold text-primary">{{ $reg->registration_code }}</td>
                                <td class="px-4 py-4 text-sm font-semibold text-gray-800 dark:text-white searchable">{{ $reg->full_name }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400 searchable">{{ $reg->nisn }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $reg->school_origin }}</td>
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <i class="fas fa-check-circle mr-1"></i> DITERIMA
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- No Search Results --}}
            <div id="no-results" class="hidden bg-gray-100 dark:bg-gray-800 rounded-xl p-8 text-center mt-6">
                <i class="fas fa-search text-gray-400 text-4xl mb-3"></i>
                <p class="text-gray-600 dark:text-gray-400">Tidak ada hasil yang cocok dengan pencarian Anda.</p>
            </div>
            @endif

            {{-- Back Button --}}
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white font-bold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Simple search functionality
        document.getElementById('search-input')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.result-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const searchables = row.querySelectorAll('.searchable');
                let found = false;
                searchables.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                    }
                });
                
                if (found || searchTerm === '') {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide no results message
            const noResults = document.getElementById('no-results');
            if (visibleCount === 0 && searchTerm !== '') {
                noResults?.classList.remove('hidden');
            } else {
                noResults?.classList.add('hidden');
            }
        });
    </script>
    @endpush
</x-layouts.app>
