<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['headmaster' => null, 'categories' => collect()]));

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

foreach (array_filter((['headmaster' => null, 'categories' => collect()]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<aside class="space-y-8">
    
    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Pencarian</h4>
        <form action="<?php echo e(route('posts.search')); ?>" method="GET" class="relative">
            <input type="text" 
                   name="q"
                   value="<?php echo e(request('q')); ?>"
                   class="w-full pl-4 pr-10 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                   placeholder="Cari artikel...">
            <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-primary transition-colors">
                <i class="fas fa-search text-lg"></i>
            </button>
        </form>
    </div>
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($headmaster): ?>
    <div class="bg-primary rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
        <h4 class="text-lg font-bold mb-4 font-display border-b border-white/20 pb-2">Sambutan Kepala Sekolah</h4>
        <div class="flex items-center space-x-4 mb-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($headmaster->photo): ?>
                <img src="<?php echo e(Storage::url($headmaster->photo)); ?>" 
                     alt="<?php echo e($headmaster->name); ?>" 
                     class="w-16 h-16 rounded-full border-2 border-secondary object-cover">
            <?php else: ?>
                <div class="w-16 h-16 rounded-full border-2 border-secondary bg-white/10 flex items-center justify-center">
                    <i class="fas fa-user text-2xl text-white/50"></i>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div>
                <p class="font-bold text-sm"><?php echo e($headmaster->name); ?></p>
                <p class="text-xs text-blue-200"><?php echo e($headmaster->position); ?></p>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($headmaster->quote): ?>
        <p class="text-sm text-blue-100 italic mb-4">
            "<?php echo e($headmaster->quote); ?>"
        </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <a href="<?php echo e(route('pages.sambutan')); ?>" class="text-xs font-bold text-secondary hover:text-white uppercase tracking-wider flex items-center">
            Baca Sambutan <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
        </a>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categories->isNotEmpty()): ?>
    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Kategori</h4>
        <ul class="space-y-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('categories.show', $category->slug)); ?>" 
                   class="flex justify-between items-center text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition-colors py-2 border-b border-dashed border-gray-200 dark:border-gray-700">
                    <span><?php echo e($category->name); ?></span>
                    <span class="bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded-full"><?php echo e($category->posts_count ?? 0); ?></span>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
     
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($settings->sidebar_video_url) && $settings->sidebar_video_url): ?>
        <?php
            $videoUrl = $settings->sidebar_video_url;
            $embedUrl = null;
            
            // Extract YouTube video ID and create embed URL (supports watch, embed, live, and youtu.be)
            if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|live\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
                $videoId = $matches[1];
                $embedUrl = "https://www.youtube-nocookie.com/embed/" . $videoId;
            }
        ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($embedUrl): ?>
        <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm p-6 mb-8 border border-gray-100 dark:border-gray-700">
            <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Video Terbaru</h4>
            
            <div class="aspect-video rounded-lg overflow-hidden shadow-md">
                <iframe src="<?php echo e($embedUrl); ?>" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen 
                        class="w-full h-full">
                </iframe>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    
    <?php
        $links = \App\Models\Link::where('is_active', true)->orderBy('order', 'asc')->get();
    ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($links->count() > 0): ?>
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm p-6 mb-8 border border-gray-100 dark:border-gray-700">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Tautan Populer</h4>
        
        <div class="flex flex-wrap gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($link->url); ?>" target="<?php echo e($link->target); ?>" class="px-4 py-2 bg-gray-50 dark:bg-gray-700 hover:bg-secondary hover:text-primary text-gray-600 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors duration-300">
                <?php echo e($link->title); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</aside>
<?php /**PATH /var/www/html/resources/views/components/sidebar.blade.php ENDPATH**/ ?>