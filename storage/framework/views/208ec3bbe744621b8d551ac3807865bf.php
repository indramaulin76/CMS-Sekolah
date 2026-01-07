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

<footer class="bg-primary-dark text-white border-t-4 border-secondary mt-auto">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5 class="text-xl font-bold font-display"><?php echo e($settings->school_name ?? 'SMA Tunas Harapan'); ?></h5>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Membentuk karakter siswa yang religius, cerdas, terampil, dan mandiri serta berbudaya lingkungan.
                </p>
                <div class="flex space-x-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->facebook_url): ?>
                    <a href="<?php echo e($settings->facebook_url); ?>" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->instagram_url): ?>
                    <a href="<?php echo e($settings->instagram_url); ?>" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->tiktok_url): ?>
                    <a href="<?php echo e($settings->tiktok_url); ?>" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fa-brands fa-tiktok text-sm"></i>
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->youtube_url): ?>
                    <a href="<?php echo e($settings->youtube_url); ?>" target="_blank" class="w-8 h-8 rounded bg-white/10 flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div>
                <h5 class="text-lg font-bold mb-6 text-white border-l-4 border-secondary pl-3">Tautan Cepat</h5>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="<?php echo e(route('pages.profil')); ?>" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Profil Sekolah</a></li>
                    <li><a href="<?php echo e(route('pages.visi-misi')); ?>" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Visi & Misi</a></li>
                    <li><a href="<?php echo e(route('posts.index')); ?>" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Berita</a></li>
                    <li><a href="<?php echo e(route('events.index')); ?>" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Agenda</a></li>
                    <li><a href="<?php echo e(route('pages.kontak')); ?>" class="hover:text-secondary transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Hubungi Kami</a></li>
                </ul>
            </div>

            
            <div>
                <h5 class="text-lg font-bold mb-6 text-white border-l-4 border-secondary pl-3">Kontak Kami</h5>
                <ul class="space-y-4 text-sm text-gray-400">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->address): ?>
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-secondary"></i>
                        <span><?php echo e($settings->address); ?></span>
                    </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->phone): ?>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-secondary"></i>
                        <span><?php echo e($settings->phone); ?></span>
                    </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->email): ?>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-secondary"></i>
                        <span><?php echo e($settings->email); ?></span>
                    </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->office_hours): ?>
                    <li class="flex items-center">
                        <i class="fas fa-clock mr-3 text-secondary"></i>
                        <span><?php echo e($settings->office_hours); ?></span>
                    </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            
            <div>
                <h5 class="text-lg font-bold mb-6 text-white border-l-4 border-secondary pl-3">Berlangganan</h5>
                <p class="text-gray-400 text-sm mb-4">Dapatkan informasi terbaru mengenai kegiatan sekolah.</p>
                <form class="space-y-3" action="#" method="POST">
                    <?php echo csrf_field(); ?>
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

        
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-xs text-gray-500">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($settings->school_name ?? 'SMA Tunas Harapan'); ?>. All Rights Reserved. | Designed with <i class="fas fa-heart text-red-500"></i> for Education.</p>
        </div>
    </div>
</footer>
<?php /**PATH /var/www/html/resources/views/components/footer.blade.php ENDPATH**/ ?>