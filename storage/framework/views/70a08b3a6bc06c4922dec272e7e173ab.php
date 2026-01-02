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
        
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display">
                <i class="fas fa-calendar-alt text-secondary mr-3"></i>Agenda Kegiatan
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Jadwal kegiatan dan acara sekolah</p>
        </div>
        
        
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 flex items-center">
            <span class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm mr-3">
                <i class="fas fa-arrow-up"></i>
            </span>
            Agenda Mendatang
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden card-hover border border-gray-100 dark:border-gray-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->thumbnail): ?>
                    <img src="<?php echo e(Storage::url($event->thumbnail)); ?>" 
                         alt="<?php echo e($event->title); ?>" 
                         class="w-full h-48 object-cover">
                <?php else: ?>
                    <div class="w-full h-48 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                        <i class="fas fa-calendar-check text-white text-5xl opacity-50"></i>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="p-6">
                    <div class="flex items-center text-sm text-primary dark:text-secondary mb-3">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <?php echo e($event->event_date->translatedFormat('d F Y')); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->event_time): ?>
                            <span class="mx-2">•</span>
                            <i class="far fa-clock mr-1"></i>
                            <?php echo e(\Carbon\Carbon::parse($event->event_time)->format('H:i')); ?> WIB
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3 line-clamp-2">
                        <?php echo e($event->title); ?>

                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-secondary"></i>
                        <?php echo e($event->location); ?>

                    </p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->organizer): ?>
                    <p class="text-gray-500 dark:text-gray-500 text-xs flex items-center mb-4">
                        <i class="fas fa-users mr-2"></i>
                        Penyelenggara: <?php echo e($event->organizer); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <a href="<?php echo e(route('events.show', $event->slug)); ?>" class="inline-flex items-center text-sm font-semibold text-primary dark:text-secondary hover:underline">
                        Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12 bg-surface-light dark:bg-surface-dark rounded-xl">
                <i class="fas fa-calendar-times text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400">Tidak ada agenda mendatang saat ini.</p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($upcomingEvents->hasPages()): ?>
        <div class="mb-12">
            <?php echo e($upcomingEvents->links()); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pastEvents->isNotEmpty()): ?>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 flex items-center">
            <span class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white text-sm mr-3">
                <i class="fas fa-history"></i>
            </span>
            Agenda Sebelumnya
        </h2>
        
        <div class="space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pastEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white dark:bg-surface-dark rounded-lg shadow-sm p-4 flex items-center justify-between border border-gray-100 dark:border-gray-700 opacity-75 hover:opacity-100 transition-opacity">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center flex-shrink-0">
                        <div class="text-center">
                            <span class="block text-xl font-bold text-gray-600 dark:text-gray-400"><?php echo e($event->event_date->format('d')); ?></span>
                            <span class="block text-xs text-gray-500"><?php echo e($event->event_date->translatedFormat('M Y')); ?></span>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300"><?php echo e($event->title); ?></h4>
                        <p class="text-sm text-gray-500"><?php echo e($event->location); ?></p>
                    </div>
                </div>
                <a href="<?php echo e(route('events.show', $event->slug)); ?>" class="text-primary dark:text-secondary text-sm hover:underline">
                    Detail
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php /**PATH /var/www/html/resources/views/events/index.blade.php ENDPATH**/ ?>