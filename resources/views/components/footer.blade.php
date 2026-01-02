@props(['settings'])

<footer class="bg-primary-dark text-white border-t-4 border-secondary mt-auto">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- About --}}
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5 class="text-xl font-bold font-display">{{ $settings->school_name ?? 'SMA Tunas Harapan' }}</h5>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Membentuk karakter siswa yang religius, cerdas, terampil, dan mandiri serta berbudaya lingkungan.
                </p>
                <div class="flex space-x-3">
                    @if($settings && $settings->facebook_url)
                    <a href="{{ $settings->facebook_url }}" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    @endif
                    @if($settings && $settings->instagram_url)
                    <a href="{{ $settings->instagram_url }}" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    @endif
                    @if($settings && $settings->tiktok_url)
                    <a href="{{ $settings->tiktok_url }}" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fa-brands fa-tiktok text-sm"></i>
                    </a>
                    @endif
                    @if($settings && $settings->youtube_url)
                    <a href="{{ $settings->youtube_url }}" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h5 class="text-lg font-bold mb-6 text-white border-l-4 border-secondary pl-3">Tautan Cepat</h5>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('pages.profil') }}" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Profil Sekolah</a></li>
                    <li><a href="{{ route('pages.visi-misi') }}" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Visi & Misi</a></li>
                    <li><a href="{{ route('posts.index') }}" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Berita</a></li>
                    <li><a href="{{ route('events.index') }}" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Agenda</a></li>
                    <li><a href="{{ route('pages.kontak') }}" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Hubungi Kami</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h5 class="text-lg font-bold mb-6 text-white border-l-4 border-secondary pl-3">Kontak Kami</h5>
                <ul class="space-y-4 text-sm text-gray-400">
                    @if($settings && $settings->address)
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-secondary"></i>
                        <span>{{ $settings->address }}</span>
                    </li>
                    @endif
                    @if($settings && $settings->phone)
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-secondary"></i>
                        <span>{{ $settings->phone }}</span>
                    </li>
                    @endif
                    @if($settings && $settings->email)
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-secondary"></i>
                        <span>{{ $settings->email }}</span>
                    </li>
                    @endif
                    @if($settings && $settings->office_hours)
                    <li class="flex items-center">
                        <i class="fas fa-clock mr-3 text-secondary"></i>
                        <span>{{ $settings->office_hours }}</span>
                    </li>
                    @endif
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h5 class="text-lg font-bold mb-6 text-white border-l-4 border-secondary pl-3">Berlangganan</h5>
                <p class="text-gray-400 text-sm mb-4">Dapatkan informasi terbaru mengenai kegiatan sekolah.</p>
                <form class="space-y-3" action="#" method="POST">
                    @csrf
                    <input type="email" 
                           class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded text-sm text-white focus:outline-none focus:border-secondary" 
                           placeholder="Email Anda" 
                           required>
                    <button type="submit" class="w-full bg-secondary text-primary font-bold py-2 rounded text-sm hover:bg-yellow-400 transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} {{ $settings->school_name ?? 'SMA Tunas Harapan' }}. All Rights Reserved. | Designed with <i class="fas fa-heart text-red-500"></i> for Education.</p>
        </div>
    </div>
</footer>
