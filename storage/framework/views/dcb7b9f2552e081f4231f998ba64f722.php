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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Pendaftaran Berhasil','subtitle' => 'Data pendaftaran Anda telah kami terima','icon' => 'fas fa-check-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pendaftaran Berhasil','subtitle' => 'Data pendaftaran Anda telah kami terima','icon' => 'fas fa-check-circle']); ?>
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

    <div class="container mx-auto px-4 lg:px-8 pb-12">
        <div class="max-w-3xl mx-auto text-center">
            <div class="p-8 bg-green-50 dark:bg-green-900/20 rounded-2xl border border-green-100 dark:border-green-800">
                <div class="w-20 h-20 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-green-600 dark:text-green-400 text-4xl"></i>
                </div>
                
                <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm max-w-md mx-auto mb-6">
                    <p class="text-sm text-gray-500 mb-1">Kode Pendaftaran Anda:</p>
                    <div class="text-3xl font-mono font-bold text-primary tracking-wider select-all">
                        <?php echo e($registration->registration_code); ?>

                    </div>
                    <p class="text-xs text-gray-400 mt-2">Simpan kode ini untuk mengecek status pendaftaran.</p>
                </div>

                
                <div class="mb-6">
                    <a href="<?php echo e(route('ppdb.print', $registration->registration_code)); ?>" 
                       class="inline-flex items-center px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-download mr-2"></i> Download Kartu Pendaftaran (PDF)
                    </a>
                </div>

                <div class="text-gray-600 dark:text-gray-300 space-y-4 text-left p-6 bg-white/50 dark:bg-black/10 rounded-xl">
                    <h3 class="font-bold text-lg mb-2 text-center">Langkah Selanjutnya:</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="w-6 h-6 flex items-center justify-center bg-primary text-white rounded-full text-xs font-bold mr-3 mt-0.5">1</span>
                            <span>Download dan cetak <strong>Kartu Pendaftaran</strong> di atas.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-6 h-6 flex items-center justify-center bg-primary text-white rounded-full text-xs font-bold mr-3 mt-0.5">2</span>
                            <span>Siapkan berkas: <strong>FC KK, FC Akta Kelahiran, FC Ijazah/SKL</strong>.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-6 h-6 flex items-center justify-center bg-primary text-white rounded-full text-xs font-bold mr-3 mt-0.5">3</span>
                            <span>Datang ke sekolah untuk <strong>verifikasi berkas</strong> dengan membawa kartu dan dokumen.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-6 h-6 flex items-center justify-center bg-primary text-white rounded-full text-xs font-bold mr-3 mt-0.5">4</span>
                            <span>Tunggu pengumuman hasil seleksi sesuai jadwal yang ditentukan.</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8">
                <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white font-bold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
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
<?php /**PATH /var/www/html/resources/views/ppdb/success.blade.php ENDPATH**/ ?>