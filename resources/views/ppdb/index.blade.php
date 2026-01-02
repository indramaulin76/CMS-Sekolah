<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-10">
                <span class="inline-block px-3 py-1 mb-4 text-xs font-bold tracking-wider text-primary uppercase bg-secondary rounded shadow">
                    Tahun Ajaran {{ $activePeriod->academic_year }}
                </span>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white font-display mb-4">
                    Penerimaan Peserta Didik Baru
                </h1>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Silakan lengkapi formulir di bawah ini dengan data yang benar dan valid untuk mendaftar sebagai calon siswa baru.
                </p>
            </div>

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
                
                {{-- Section 1: Data Pribadi Siswa --}}
                <div class="bg-white dark:bg-surface-dark rounded-xl p-6 lg:p-8 shadow-lg border-t-4 border-primary">
                    <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                        <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm mr-3">1</span>
                        Data Pribadi Siswa
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
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katholik" {{ old('religion') == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                                <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('religion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 6. NISN --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">6. NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" required maxlength="10" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="10 digit">
                            @error('nisn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 8. NIK --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">8. NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="16 digit">
                            @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 2: Kontak & Asal Sekolah --}}
                <div class="bg-white dark:bg-surface-dark rounded-xl p-6 lg:p-8 shadow-lg border-t-4 border-primary">
                    <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                        <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm mr-3">2</span>
                        Kontak & Asal Sekolah
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- 7. Asal Sekolah --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">7. Asal Sekolah (SMP/MTs) <span class="text-red-500">*</span></label>
                            <input type="text" name="school_origin" value="{{ old('school_origin') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('school_origin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 13. Nomor HP Siswa --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">13. Nomor HP Siswa (WA Aktif) <span class="text-red-500">*</span></label>
                            <input type="tel" name="student_phone" value="{{ old('student_phone') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="08xxxxxxxxxx">
                            @error('student_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 3: Data Orang Tua & KK --}}
                <div class="bg-white dark:bg-surface-dark rounded-xl p-6 lg:p-8 shadow-lg border-t-4 border-primary">
                    <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                        <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm mr-3">3</span>
                        Data Orang Tua & Kartu Keluarga
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- 9. Nomor KK --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">9. Nomor Kartu Keluarga <span class="text-red-500">*</span></label>
                            <input type="text" name="kk_number" value="{{ old('kk_number') }}" required maxlength="16" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="16 digit">
                            @error('kk_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 10. Nama Orang Tua --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">10. Nama Orang Tua (Ayah/Ibu) <span class="text-red-500">*</span></label>
                            <input type="text" name="parent_name" value="{{ old('parent_name') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 11. Alamat Orang Tua --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">11. Alamat Orang Tua <span class="text-red-500">*</span></label>
                            <textarea name="parent_address" rows="3" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('parent_address') }}</textarea>
                            @error('parent_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 12. Pekerjaan Ortu --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">12. Pekerjaan Orang Tua</label>
                            <input type="text" name="parent_job" value="{{ old('parent_job') }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                            @error('parent_job') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
    </div>

    {{-- reCAPTCHA v3 Script --}}
    @if(config('services.recaptcha.site_key'))
    @push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script>
        document.getElementById('ppdb-form').addEventListener('submit', function(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'ppdb_register'}).then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    document.getElementById('ppdb-form').submit();
                });
            });
        });
    </script>
    @endpush
    @endif
</x-layouts.app>
