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


<section class="relative bg-gray-900">
    <div class="relative h-[400px] md:h-[500px] lg:h-[600px] w-full overflow-hidden">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->hero_image): ?>
            <img src="<?php echo e(Storage::url($settings->hero_image)); ?>" 
                 alt="SMA Tunas Harapan" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80">
        <?php else: ?>
            <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary-dark to-primary opacity-90"></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-6 pb-20 md:p-12 md:pb-24 lg:p-16 lg:pb-32">
            <div class="container mx-auto">
                <span class="inline-block px-3 py-1 mb-4 text-xs font-bold tracking-wider text-primary uppercase bg-secondary rounded shadow">
                    Selamat Datang
                </span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-display leading-tight drop-shadow-md">
                    <?php echo nl2br(e($settings->hero_title ?? 'Membangun Generasi Cerdas & Berkarakter')); ?>

                </h2>
                <p class="text-gray-200 text-lg md:text-xl max-w-2xl drop-shadow mb-8">
                    <?php echo e($settings->hero_subtitle ?? 'SMA Tunas Harapan berkomitmen mencetak pemimpin masa depan yang berakhlak mulia dan berwawasan global.'); ?>

                </p>
            </div>
        </div>
    </div>
</section>


<?php /**PATH /var/www/html/resources/views/components/hero.blade.php ENDPATH**/ ?>