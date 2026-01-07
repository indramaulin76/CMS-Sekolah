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
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Struktur Organisasi','subtitle' => 'SMA Tunas Harapan dikelola oleh tenaga pendidik dan kependidikan yang profesional dan berdedikasi.','icon' => 'fas fa-sitemap']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Struktur Organisasi','subtitle' => 'SMA Tunas Harapan dikelola oleh tenaga pendidik dan kependidikan yang profesional dan berdedikasi.','icon' => 'fas fa-sitemap']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto pb-12">
            <!-- Org Chart Container -->
            <div class="flex flex-col items-center">
                
                <!-- Level 1: Kepala Sekolah -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($headmaster): ?>
                <div class="flex flex-col items-center mb-12 relative z-10">
                    <div class="bg-primary text-white p-6 rounded-lg shadow-lg text-center w-64 border-b-4 border-blue-800">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($headmaster->photo): ?>
                            <img src="<?php echo e(Storage::url($headmaster->photo)); ?>" alt="<?php echo e($headmaster->name); ?>" class="w-24 h-24 rounded-full object-cover mx-auto mb-3 border-4 border-white/20">
                        <?php else: ?>
                            <div class="w-24 h-24 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user text-4xl text-white/50"></i>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="text-sm uppercase tracking-wide opacity-80 mb-1">Kepala Sekolah</div>
                        <div class="font-bold text-lg"><?php echo e($headmaster->name); ?></div>

                    </div>
                </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <!-- Level 2 Connector -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($wakas->count() > 0): ?>
                <div class="w-full flex justify-center mb-12">
                    <div class="relative w-full flex flex-col items-center">
                        <!-- Wakas Grid -->
                        <div class="flex flex-wrap justify-center gap-8 z-10 w-full px-4 relative">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $wakas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex flex-col items-center relative">
                                <!-- Box -->
                                <div class="bg-secondary/20 border border-secondary text-gray-800 dark:text-gray-100 p-4 rounded-lg shadow-sm text-center w-56 hover:shadow-md transition bg-white dark:bg-gray-800">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($waka->photo): ?>
                                        <img src="<?php echo e(Storage::url($waka->photo)); ?>" alt="<?php echo e($waka->name); ?>" class="w-20 h-20 rounded-full object-cover mx-auto mb-3 border-2 border-secondary">
                                    <?php else: ?>
                                        <div class="w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                            <i class="fas fa-user text-3xl text-gray-400"></i>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="text-xs uppercase font-bold text-secondary mb-1"><?php echo e($waka->position); ?></div>
                                    <div class="font-bold text-md leading-tight"><?php echo e($waka->name); ?></div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                <!-- Level 3: Guru & Staff Group -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($others->count() > 0): ?>
                <div class="w-full mt-8">
                    <div class="text-center mb-8 relative">
                        <span class="bg-gray-50 dark:bg-gray-800 px-4 text-gray-400 text-sm relative z-10 uppercase tracking-widest font-bold">Dewan Guru & Staff</span>
                        <div class="absolute top-1/2 w-full border-t border-gray-200 -z-0"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $others; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white dark:bg-surface-dark border border-gray-100 dark:border-gray-700 p-4 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($staff->photo): ?>
                                <img src="<?php echo e(Storage::url($staff->photo)); ?>" alt="<?php echo e($staff->name); ?>" class="w-16 h-16 rounded-full object-cover mx-auto mb-3 border border-gray-200">
                            <?php else: ?>
                                <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center mx-auto mb-3 border border-gray-100 dark:border-gray-700">
                                    <i class="fas fa-user text-2xl text-gray-300"></i>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="font-bold text-gray-800 dark:text-gray-100 group-hover:text-primary transition"><?php echo e($staff->name); ?></div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?php echo e($staff->position); ?></div>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php /**PATH /var/www/html/resources/views/pages/organisasi.blade.php ENDPATH**/ ?>