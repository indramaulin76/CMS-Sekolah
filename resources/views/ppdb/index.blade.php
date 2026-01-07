<x-layouts.app :settings="$settings ?? null">
    <x-page-header 
        title="Penerimaan Peserta Didik Baru" 
        :subtitle="$activePeriod ? 'Tahun Ajaran ' . $activePeriod->academic_year : 'SMA Tunas Harapan'"
        icon="fas fa-user-graduate"
    />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            @if($activePeriod)
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-6 lg:p-10 border-t-4 border-secondary">
            <div class="mb-8 text-center">
                 <p class="text-gray-600 dark:text-gray-300">
                    Silakan lengkapi formulir di bawah ini dengan data yang benar dan valid untuk mendaftar sebagai calon siswa baru.
                </p>
            </div>

            {{-- Period Description --}}
            @if($activePeriod->description)
            <div class="mb-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                <h3 class="text-lg font-bold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Informasi Pendaftaran
                </h3>
                <div class="prose prose-sm dark:prose-invert max-w-none text-blue-700 dark:text-blue-200">
                    {!! $activePeriod->description !!}
                </div>
            </div>
            @endif

            {{-- Requirements --}}
            @if($activePeriod->requirements)
            <div class="mb-8 p-6 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-100 dark:border-yellow-800">
                <h3 class="text-lg font-bold text-yellow-800 dark:text-yellow-300 mb-3 flex items-center">
                    <i class="fas fa-clipboard-list mr-2"></i> Persyaratan Pendaftaran
                </h3>
                <div class="prose prose-sm dark:prose-invert max-w-none text-yellow-700 dark:text-yellow-200">
                    {!! $activePeriod->requirements !!}
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Gagal!</p>
                <p>{{ session('error') }}</p>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Ada kesalahan pada input Anda:</p>
                <ul class="list-disc ml-5 mt-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('ppdb.register') }}" method="POST" class="space-y-8" id="ppdb-form">
                @csrf
                
                {{-- reCAPTCHA Hidden Input --}}
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                
                {{-- Form Fields 1-14 --}}
                <div class="bg-white dark:bg-surface-dark rounded-xl p-6 lg:p-8 shadow-lg border-t-4 border-primary">
                    <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                        <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm mr-3"><i class="fas fa-file-alt"></i></span>
                        Data Pendaftaran
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- 1. Nama Lengkap --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">1. Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 2. Jenis Kelamin --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">2. Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih...</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 3. Tempat Lahir --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">3. Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('birth_place') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 4. Tanggal Lahir --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">4. Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('birth_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 5. Agama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">5. Agama <span class="text-red-500">*</span></label>
                            <select name="religion" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih...</option>
                                @foreach(['Islam', 'Kristen', 'Katholik', 'Buddha', 'Hindu', 'Konghucu'] as $agama)
                                <option value="{{ $agama }}" {{ old('religion') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                            @error('religion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 6. NISN --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">6. NISN Siswa <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" required maxlength="10" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="10 digit">
                            @error('nisn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 7. Asal Sekolah --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">7. Asal Sekolah (SMP/MTs) <span class="text-red-500">*</span></label>
                            <input type="text" name="previous_school" value="{{ old('previous_school') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('previous_school') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 8. NIK Siswa --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">8. NIK Siswa <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="16 digit">
                            @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 9. KK --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">9. Nomor Kartu Keluarga <span class="text-red-500">*</span></label>
                            <input type="text" name="kk_number" value="{{ old('kk_number') }}" required maxlength="16" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="16 digit">
                            @error('kk_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 10. Nama Orang Tua --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">10. Nama Orang Tua <span class="text-red-500">*</span></label>
                            <input type="text" name="parent_name" value="{{ old('parent_name') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 11. Alamat Orang Tua --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">11. Alamat Orang Tua <span class="text-red-500">*</span></label>
                            <textarea name="parent_address" rows="3" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('parent_address') }}</textarea>
                            @error('parent_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 12. Pekerjaan Orang Tua --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">12. Pekerjaan Orang Tua <span class="text-red-500">*</span></label>
                            <input type="text" name="parent_occupation" value="{{ old('parent_occupation') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('parent_occupation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 13. Nomor HP Siswa --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">13. Nomor HP Siswa (WA Aktif) <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="08xxxxxxxxxx">
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 14. Nomor HP Orang Tua --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">14. Nomor HP Orang Tua (WA Aktif) <span class="text-red-500">*</span></label>
                            <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="08xxxxxxxxxx">
                            @error('parent_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-4 bg-secondary text-primary font-bold rounded-xl shadow-lg hover:bg-yellow-400 transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="max-w-2xl mx-auto py-16 text-center">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-8 border border-gray-100 dark:border-gray-700">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-hourglass-start text-4xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
                    Pendaftaran Belum Dibuka
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mb-8">
                    Mohon maaf, pendaftaran peserta didik baru (PPDB) saat ini belum dibuka atau tidak ada periode aktif. Silakan kembali lagi nanti atau hubungi pihak sekolah untuk informasi lebih lanjut.
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('home') }}" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-colors">
                        <i class="fas fa-home mr-2"></i> Ke Beranda
                    </a>
                    <a href="{{ route('pages.kontak') }}" class="px-6 py-2 bg-white text-gray-700 border border-gray-300 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-envelope mr-2"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
        @endif
        </div>
    </div>

    {{-- reCAPTCHA v3 Script --}}
    @if(config('services.recaptcha.site_key'))
    @push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script>
        const ppdbForm = document.getElementById('ppdb-form');
        if (ppdbForm) {
            ppdbForm.addEventListener('submit', function(e) {
                e.preventDefault();
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'ppdb_register'}).then(function(token) {
                        document.getElementById('g-recaptcha-response').value = token;
                        ppdbForm.submit();
                    });
                });
            });
        }
    </script>
    @endpush
    @endif
</x-layouts.app>
