

<?php $__env->startSection('title', 'Riwayat Pengunjung - PromoDiskon'); ?>
<?php $__env->startSection('page-title', 'Riwayat Pengunjung'); ?>
<?php $__env->startSection('page-desc', 'Pantau pengunjung yang membuka halaman promosi.'); ?>

<?php $__env->startSection('content'); ?>
    <form class="filter-bar" method="get" action="<?php echo e(route('admin.visitors.index')); ?>">
        <input type="text" name="path" placeholder="Filter path" value="<?php echo e(request('path')); ?>">
        <input type="date" name="date" value="<?php echo e(request('date')); ?>">
        <button class="btn btn-primary" type="submit">Terapkan</button>
    </form>

    <div class="table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Path</th>
                    <th>IP</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($log->visited_at->format('d-m-Y H:i')); ?></td>
                        <td><?php echo e($log->path); ?></td>
                        <td><?php echo e($log->ip_address); ?></td>
                        <td class="muted"><?php echo e($log->user_agent); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <h3>Belum ada data pengunjung</h3>
                                <p>Data akan muncul setelah halaman publik dikunjungi.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <?php echo $__env->make('partials.pagination', ['paginator' => $logs], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/admin/visitors/index.blade.php ENDPATH**/ ?>