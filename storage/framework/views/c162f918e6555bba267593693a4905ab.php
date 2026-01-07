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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Pengumuman Hasil PPDB','subtitle' => 'Tahun Ajaran ' . $period->academic_year,'icon' => 'fas fa-bullhorn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pengumuman Hasil PPDB','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Tahun Ajaran ' . $period->academic_year),'icon' => 'fas fa-bullhorn']); ?>
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
        <div class="max-w-5xl mx-auto">
            <div class="mb-8 text-center">
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Berikut adalah daftar calon peserta didik baru yang <strong class="text-green-600">DITERIMA</strong> di SMA Tunas Harapan.
                </p>
            </div>

            
            <div class="bg-white dark:bg-surface-dark rounded-xl p-8 mb-8 shadow-lg border-t-4 border-secondary">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-gray-200 dark:divide-gray-700">
                    <div class="py-2 md:py-0">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1 font-medium uppercase tracking-wide">Periode</div>
                        <div class="font-bold text-xl text-gray-800 dark:text-white"><?php echo e($period->name); ?></div>
                    </div>
                    <div class="py-2 md:py-0">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1 font-medium uppercase tracking-wide">Total Diterima</div>
                        <div class="font-bold text-4xl text-yellow-500"><?php echo e($acceptedRegistrations->count()); ?></div>
                    </div>
                    <div class="py-2 md:py-0">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1 font-medium uppercase tracking-wide">Tanggal Pengumuman</div>
                        <div class="font-bold text-xl text-gray-800 dark:text-white"><?php echo e($period->announcement_date?->format('d F Y') ?? '-'); ?></div>
                    </div>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($acceptedRegistrations->isEmpty()): ?>
            
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-10 text-center">
                <i class="fas fa-info-circle text-yellow-500 text-5xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Belum Ada Pengumuman</h3>
                <p class="text-gray-600 dark:text-gray-400">Daftar peserta yang diterima belum tersedia. Silakan cek kembali nanti.</p>
            </div>
            <?php else: ?>
            
            <div class="mb-6">
                <div class="relative max-w-4xl mx-auto">
                    <input type="text" id="search-input" placeholder="Cari berdasarkan nama atau NISN..." 
                           class="w-full px-5 py-4 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent shadow-sm">
                </div>
            </div>

            
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="w-full" id="results-table">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Kode Pendaftaran</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Nama Lengkap</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">NISN</th>
                                <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">Asal Sekolah</th>
                                <th class="px-6 py-4 text-center text-sm font-bold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $acceptedRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors result-row">
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400"><?php echo e($index + 1); ?></td>
                                <td class="px-4 py-4 text-sm font-mono font-bold text-primary"><?php echo e($reg->registration_code); ?></td>
                                <td class="px-4 py-4 text-sm font-semibold text-gray-800 dark:text-white searchable"><?php echo e($reg->full_name); ?></td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400 searchable"><?php echo e($reg->nisn); ?></td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400"><?php echo e($reg->school_origin); ?></td>
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <i class="fas fa-check-circle mr-1"></i> DITERIMA
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div id="no-results" class="hidden bg-gray-100 dark:bg-gray-800 rounded-xl p-8 text-center mt-6">
                <i class="fas fa-search text-gray-400 text-4xl mb-3"></i>
                <p class="text-gray-600 dark:text-gray-400">Tidak ada hasil yang cocok dengan pencarian Anda.</p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="mt-8 text-center">
                <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white font-bold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Simple search functionality
        document.getElementById('search-input')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.result-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const searchables = row.querySelectorAll('.searchable');
                let found = false;
                searchables.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                    }
                });
                
                if (found || searchTerm === '') {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide no results message
            const noResults = document.getElementById('no-results');
            if (visibleCount === 0 && searchTerm !== '') {
                noResults?.classList.remove('hidden');
            } else {
                noResults?.classList.add('hidden');
            }
        });
    </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH /var/www/html/resources/views/ppdb/pengumuman.blade.php ENDPATH**/ ?>