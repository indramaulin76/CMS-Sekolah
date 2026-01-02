<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['post']));

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

foreach (array_filter((['post']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<article class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 group flex flex-col md:flex-row card-hover">
    
    <div class="md:w-1/3 relative overflow-hidden h-48 md:h-auto">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->thumbnail): ?>
            <img src="<?php echo e(Storage::url($post->thumbnail)); ?>" 
                 alt="<?php echo e($post->title); ?>" 
                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($post->title)); ?>&background=random&color=fff&size=500'; this.parentElement.classList.add('bg-gray-200');"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                <i class="fas fa-newspaper text-white text-4xl opacity-50"></i>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->category): ?>
        <div class="absolute top-2 left-2 badge-<?php echo e($post->category->color ?? 'gray'); ?> text-xs font-bold px-2 py-1 rounded">
            <?php echo e($post->category->name); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    
    
    <div class="p-6 md:w-2/3 flex flex-col justify-between">
        <div>
            
            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2 space-x-3">
                <span><i class="far fa-calendar mr-1"></i> <?php echo e($post->published_at?->translatedFormat('d M Y') ?? '-'); ?></span>
                <span><i class="far fa-user mr-1"></i> <?php echo e($post->user?->name ?? 'Admin'); ?></span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->views_count > 0): ?>
                <span><i class="far fa-eye mr-1"></i> <?php echo e(number_format($post->views_count)); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            
            <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2 group-hover:text-primary dark:group-hover:text-secondary transition-colors line-clamp-2">
                <a href="<?php echo e(route('posts.show', $post->slug)); ?>"><?php echo e($post->title); ?></a>
            </h4>
            
            
            <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2 mb-4">
                <?php echo e($post->excerpt); ?>

            </p>
        </div>
        
        
        <a href="<?php echo e(route('posts.show', $post->slug)); ?>" class="inline-flex items-center text-sm font-semibold text-primary dark:text-secondary hover:underline">
            Baca Selengkapnya <i class="fas fa-long-arrow-alt-right ml-2"></i>
        </a>
    </div>
</article>
<?php /**PATH /var/www/html/resources/views/components/article-card.blade.php ENDPATH**/ ?>