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
    <div class="container mx-auto px-4 lg:px-8 py-12">
        
        <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-primary">Beranda</a>
            <span class="mx-2">/</span>
            <a href="<?php echo e(route('events.index')); ?>" class="hover:text-primary">Agenda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-300"><?php echo e(Str::limit($event->title, 30)); ?></span>
        </nav>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-2">
                
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->thumbnail): ?>
                        <img src="<?php echo e(Storage::url($event->thumbnail)); ?>" 
                             alt="<?php echo e($event->title); ?>" 
                             class="w-full h-64 md:h-96 object-cover">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <div class="p-8">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display mb-6">
                            <?php echo e($event->title); ?>

                        </h1>
                        
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-center p-4 bg-primary/10 dark:bg-primary/20 rounded-lg">
                                <i class="far fa-calendar-alt text-2xl text-primary mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Tanggal</span>
                                    <span class="font-semibold text-gray-800 dark:text-white"><?php echo e($event->event_date->translatedFormat('l, d F Y')); ?></span>
                                </div>
                            </div>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->event_time): ?>
                            <div class="flex items-center p-4 bg-secondary/10 dark:bg-secondary/20 rounded-lg">
                                <i class="far fa-clock text-2xl text-secondary mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Waktu</span>
                                    <span class="font-semibold text-gray-800 dark:text-white"><?php echo e(\Carbon\Carbon::parse($event->event_time)->format('H:i')); ?> WIB</span>
                                </div>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <div class="flex items-center p-4 bg-green-500/10 dark:bg-green-500/20 rounded-lg">
                                <i class="fas fa-map-marker-alt text-2xl text-green-500 mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Lokasi</span>
                                    <span class="font-semibold text-gray-800 dark:text-white"><?php echo e($event->location); ?></span>
                                </div>
                            </div>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->organizer): ?>
                            <div class="flex items-center p-4 bg-purple-500/10 dark:bg-purple-500/20 rounded-lg">
                                <i class="fas fa-users text-2xl text-purple-500 mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Penyelenggara</span>
                                    <span class="font-semibold text-gray-800 dark:text-white"><?php echo e($event->organizer); ?></span>
                                </div>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <?php echo \App\Helpers\HtmlSanitizer::clean($event->description); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="space-y-6">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($upcomingEvents->isNotEmpty()): ?>
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">
                        Agenda Lainnya
                    </h3>
                    <div class="space-y-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upcoming): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('events.show', $upcoming->slug)); ?>" class="block group">
                            <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-primary"><?php echo e($upcoming->event_date->format('d')); ?></span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 group-hover:text-primary dark:group-hover:text-secondary line-clamp-2">
                                        <?php echo e($upcoming->title); ?>

                                    </h4>
                                    <span class="text-xs text-gray-500"><?php echo e($upcoming->event_date->translatedFormat('M Y')); ?></span>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                
                <a href="<?php echo e(route('events.index')); ?>" class="block w-full text-center py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Agenda
                </a>
            </div>
        </div>
    </div>
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
<?php /**PATH /var/www/html/resources/views/events/show.blade.php ENDPATH**/ ?>