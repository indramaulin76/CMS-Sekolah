<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['settings' => $settings ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['settings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($settings ?? null)]); ?>
    <article class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-2">
                
                <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    <a href="<?php echo e(route('home')); ?>" class="hover:text-primary">Beranda</a>
                    <span class="mx-2">/</span>
                    <a href="<?php echo e(route('posts.index')); ?>" class="hover:text-primary">Berita</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-700 dark:text-gray-300"><?php echo e(Str::limit($post->title, 30)); ?></span>
                </nav>
                
                
                <header class="mb-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->category): ?>
                    <span class="inline-block badge-<?php echo e($post->category->color ?? 'gray'); ?> text-xs font-bold px-3 py-1 rounded mb-4">
                        <?php echo e($post->category->name); ?>

                    </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white font-display leading-tight mb-4">
                        <?php echo e($post->title); ?>

                    </h1>
                    
                    <div class="flex flex-wrap items-center text-sm text-gray-500 dark:text-gray-400 space-x-4">
                        <span><i class="far fa-calendar mr-1"></i> <?php echo e($post->published_at?->translatedFormat('d F Y')); ?></span>
                        <span><i class="far fa-user mr-1"></i> <?php echo e($post->user?->name ?? 'Admin'); ?></span>
                        <span><i class="far fa-eye mr-1"></i> <?php echo e(number_format($post->views_count)); ?> views</span>
                    </div>
                </header>
                
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->thumbnail): ?>
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                    <img src="<?php echo e(Storage::url($post->thumbnail)); ?>" 
                         alt="<?php echo e($post->title); ?>" 
                         class="w-full h-auto">
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <div class="prose prose-lg dark:prose-invert max-w-none mb-12">
                    <?php echo \App\Helpers\HtmlSanitizer::clean($post->content); ?>

                </div>
                
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mb-8">
                    <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 mr-4">Bagikan:</span>
                    <div class="inline-flex space-x-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($post->title)); ?>" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text=<?php echo e(urlencode($post->title . ' ' . request()->url())); ?>" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedPosts->isNotEmpty()): ?>
                <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Artikel Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('posts.show', $related->slug)); ?>" class="group">
                            <div class="bg-surface-light dark:bg-surface-dark rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($related->thumbnail): ?>
                                    <img src="<?php echo e(Storage::url($related->thumbnail)); ?>" 
                                         alt="<?php echo e($related->title); ?>" 
                                         class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                                <?php else: ?>
                                    <div class="w-full h-32 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                                        <i class="fas fa-newspaper text-white text-2xl opacity-50"></i>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="p-3">
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-white line-clamp-2 group-hover:text-primary dark:group-hover:text-secondary transition-colors">
                                        <?php echo e($related->title); ?>

                                    </h4>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            
            <?php if (isset($component)) { $__componentOriginal2880b66d47486b4bfeaf519598a469d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2880b66d47486b4bfeaf519598a469d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar','data' => ['categories' => $sidebarCategories ?? collect()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sidebarCategories ?? collect())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $attributes = $__attributesOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $component = $__componentOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__componentOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
        </div>
    </article>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/posts/show.blade.php ENDPATH**/ ?>