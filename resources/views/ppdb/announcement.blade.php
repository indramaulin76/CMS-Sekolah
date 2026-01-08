<x-layouts.app :settings="$settings ?? null">
    <x-page-header 
        title="Pengumuman Hasil Seleksi" 
        subtitle="Lihat daftar nama calon siswa yang dinyatakan diterima di SMA Tunas Harapan."
        icon="fas fa-bullhorn"
    />

    <div class="container mx-auto px-4 lg:px-8 pb-12">

        @if($activePeriod)
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-8 mb-8 border-t-4 border-secondary">
                <div class="text-center mb-8">
                    <h2 class="text-xl font-bold text-primary mb-2">Periode T.A {{ $activePeriod->academic_year }}</h2>
                    <p class="text-gray-700">
                        Tanggal Pengumuman: {{ $activePeriod->announcement_date ? $activePeriod->announcement_date->translatedFormat('d F Y') : 'Belum ditentukan' }}
                    </p>
                </div>

                @if($activePeriod->announcement_date && now() >= $activePeriod->announcement_date)
                    @if(count($announcements) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200">No. Pendaftaran</th>
                                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200">Nama Lengkap</th>
                                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200">Asal Sekolah</th>
                                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($announcements as $data)
                                    <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="p-4 font-mono text-sm text-primary">{{ $data->registration_code }}</td>
                                        <td class="p-4 font-bold">{{ $data->full_name }}</td>
                                        <td class="p-4 text-gray-800 dark:text-gray-200">{{ $data->school_origin }}</td>
                                        <td class="p-4">
                                            @if($data->status->value == 'accepted')
                                                <span class="inline-block px-3 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full">DITERIMA</span>
                                            @elseif($data->status->value == 'rejected')
                                                <span class="inline-block px-3 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full">TIDAK DITERIMA</span>
                                            @else
                                                <span class="inline-block px-3 py-1 text-xs font-bold text-gray-700 bg-gray-200 rounded-full">PENDING</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-700">Belum ada data pengumuman untuk ditampilkan.</p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-12 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                        <i class="fas fa-clock text-4xl text-blue-300 mb-4"></i>
                        <h3 class="text-lg font-bold text-blue-800 dark:text-blue-300 mb-2">Pengumuman Belum Dibuka</h3>
                        <p class="text-blue-600 dark:text-blue-400">
                            Silakan cek kembali pada tanggal <strong>{{ $activePeriod->announcement_date ? $activePeriod->announcement_date->translatedFormat('d F Y') : '-' }}</strong>.
                        </p>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-700">Tidak ada periode PPDB yang aktif saat ini.</p>
            </div>
        @endif
    </div>
</x-layouts.app>
