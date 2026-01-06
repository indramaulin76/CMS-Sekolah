<x-layouts.app :settings="$settings ?? null">
    <x-page-header title="Hubungi Kami" icon="fas fa-address-book" />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Contact Info --}}
                <div class="space-y-6">
                    <div class="bg-primary text-white rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold mb-4 font-display">Informasi Kontak</h3>
                        
                        <div class="space-y-4">
                            @if($settings && $settings->address)
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Alamat</h4>
                                    <p class="text-blue-200 text-sm">{{ $settings->address }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($settings && $settings->phone)
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-semibold">Telepon</h4>
                                    <p class="text-blue-200 text-sm break-all">{{ $settings->phone }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($settings && $settings->email)
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-semibold">Email</h4>
                                    <p class="text-blue-200 text-sm break-all">{{ $settings->email }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($settings && $settings->office_hours)
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-clock text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Jam Operasional</h4>
                                    <p class="text-blue-200 text-sm">{{ $settings->office_hours }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Social Media --}}
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Media Sosial</h3>
                        <div class="flex space-x-4">
                            @if($settings && $settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" class="w-12 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            @endif
                            @if($settings && $settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" target="_blank" class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-500 text-white rounded-lg flex items-center justify-center hover:from-purple-700 hover:to-pink-600 transition-colors">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            @endif
                            @if($settings && $settings->tiktok_url)
                            <a href="{{ $settings->tiktok_url }}" target="_blank" class="w-12 h-12 bg-gray-900 text-white rounded-lg flex items-center justify-center hover:bg-gray-800 transition-colors">
                                <i class="fa-brands fa-tiktok text-xl"></i>
                            </a>
                            @endif
                            @if($settings && $settings->youtube_url)
                            <a href="{{ $settings->youtube_url }}" target="_blank" class="w-12 h-12 bg-red-600 text-white rounded-lg flex items-center justify-center hover:bg-red-700 transition-colors">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Contact Form --}}
                <div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Kirim Pesan</h3>
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subjek</label>
                            <input type="text" name="subject" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pesan</label>
                            <textarea name="message" rows="4" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
            
            {{-- Map --}}
            @if($settings && $settings->map_embed_link)
            <div class="mt-8 bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden">
                <style>.map-responsive iframe { width: 100% !important; height: 100% !important; border: 0; }</style>
                <div class="aspect-video w-full map-responsive">
                    {!! $settings->map_embed_link !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
