<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['settings']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['settings']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<header class="bg-primary text-white shadow-lg sticky top-0 z-50">
    
    <div class="container mx-auto px-4 lg:px-8 py-3 flex flex-col md:flex-row justify-between items-center">
        
        <div class="flex items-center space-x-4 md:mb-0">
            <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center p-1 shadow-md">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->logo): ?>
                        <img src="<?php echo e(Storage::url($settings->logo)); ?>" alt="Logo" class="w-full h-full object-contain rounded-full">
                    <?php else: ?>
                        <i class="fas fa-graduation-cap text-primary text-2xl"></i>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold uppercase tracking-wide font-display text-white">
                        <?php echo e($settings->school_name ?? 'SMA Tunas Harapan'); ?>

                    </h1>
                    <p class="text-xs text-blue-200 font-light tracking-wider">
                        <?php echo e($settings->tagline ?? 'Sekolahnya Para Pemimpin'); ?>

                    </p>
                </div>
            </a>
        </div>
        
        
        <div class="hidden md:flex flex-row items-center space-x-6 text-sm font-medium">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->phone): ?>
            <a href="tel:<?php echo e($settings->phone); ?>" class="flex items-center hover:text-secondary transition-colors group">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-2 group-hover:bg-secondary group-hover:text-primary transition-all">
                    <i class="fas fa-phone-alt text-xs"></i>
                </span>
                <span><?php echo e($settings->phone); ?></span>
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->email): ?>
            <a href="mailto:<?php echo e($settings->email); ?>" class="flex items-center hover:text-secondary transition-colors group">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-2 group-hover:bg-secondary group-hover:text-primary transition-all">
                    <i class="fas fa-envelope text-xs"></i>
                </span>
                <span><?php echo e($settings->email); ?></span>
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    
    <nav class="bg-primary-dark border-t border-white/10" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4 lg:px-8">
            
            <div class="md:hidden flex justify-between items-center py-3">
                <span class="text-white font-medium">Menu</span>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                    <i class="fas fa-bars text-xl" x-show="!mobileMenuOpen"></i>
                    <i class="fas fa-times text-xl" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>

            
            <div class="hidden md:flex justify-center md:justify-start" id="desktop-menu">
                <a href="<?php echo e(route('pages.profil')); ?>" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Profil
                </a>
                <a href="<?php echo e(route('pages.visi-misi')); ?>" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Visi Dan Misi
                </a>
                <a href="<?php echo e(route('pages.organisasi')); ?>" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Organisasi
                </a>
                <a href="<?php echo e(route('galleries.index')); ?>" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Galeri
                </a>
                
                
                <div class="relative group nav-item" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white flex items-center">
                        Kategori <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-0 w-48 bg-white dark:bg-surface-dark shadow-xl rounded-b-lg overflow-hidden z-50">
                        <a href="<?php echo e(route('posts.index')); ?>" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm border-b border-gray-100 dark:border-gray-700">
                            Semua Berita
                        </a>
                        <a href="<?php echo e(route('events.index')); ?>" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm">
                            Agenda
                        </a>
                    </div>
                </div>
                
                
                <div class="relative group nav-item" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white flex items-center">
                        PPDB Online <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-0 w-48 bg-white dark:bg-surface-dark shadow-xl rounded-b-lg overflow-hidden z-50">
                        <a href="<?php echo e(route('ppdb.index')); ?>" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm border-b border-gray-100 dark:border-gray-700">
                            Pendaftaran
                        </a>
                        <a href="<?php echo e(route('ppdb.announcement')); ?>" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm">
                            Pengumuman
                        </a>
                    </div>
                </div>
                <a href="<?php echo e(route('pages.kontak')); ?>" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Hubungi Kami
                </a>
            </div>

            
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden pb-4" x-cloak>
                <a href="<?php echo e(route('pages.profil')); ?>" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Profil</a>
                <a href="<?php echo e(route('pages.visi-misi')); ?>" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Visi Dan Misi</a>
                <a href="<?php echo e(route('pages.organisasi')); ?>" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Organisasi</a>
                <a href="<?php echo e(route('galleries.index')); ?>" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Galeri</a>
                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center py-3 border-b border-white/10 text-white hover:text-secondary pl-2">
                        <span>Kategori</span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': subOpen}"></i>
                    </button>
                    <div x-show="subOpen" class="bg-black/20 pl-4 py-2">
                        <a href="<?php echo e(route('posts.index')); ?>" class="block py-2 text-gray-300 hover:text-white text-sm">Semua Berita</a>
                        <a href="<?php echo e(route('events.index')); ?>" class="block py-2 text-gray-300 hover:text-white text-sm">Agenda</a>
                    </div>
                </div>
                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center py-3 border-b border-white/10 text-white hover:text-secondary pl-2">
                        <span>PPDB Online</span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': subOpen}"></i>
                    </button>
                    <div x-show="subOpen" class="bg-black/20 pl-4 py-2">
                        <a href="<?php echo e(route('ppdb.index')); ?>" class="block py-2 text-gray-300 hover:text-white text-sm">Pendaftaran</a>
                        <a href="<?php echo e(route('ppdb.announcement')); ?>" class="block py-2 text-gray-300 hover:text-white text-sm">Pengumuman</a>
                    </div>
                </div>
                <a href="<?php echo e(route('pages.kontak')); ?>" class="block py-3 text-white hover:text-secondary pl-2">Hubungi Kami</a>
            </div>
        </div>
    </nav>
</header>
<?php /**PATH /var/www/html/resources/views/components/navbar.blade.php ENDPATH**/ ?>