

<?php $__env->startSection('title', 'Dashboard - PromoDiskon'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('page-desc', 'Ringkasan admin, barang, dan pengunjung.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="stats-grid">
        <div class="stat-card">
            <span>Total Admin</span>
            <strong><?php echo e($adminCount); ?></strong>
            <p>Jumlah akun admin aktif.</p>
        </div>
        <div class="stat-card">
            <span>Total Barang</span>
            <strong><?php echo e($productCount); ?></strong>
            <p>Produk yang terdaftar di promo.</p>
        </div>
        <div class="stat-card">
            <span>Pengunjung Bulan Ini</span>
            <strong><?php echo e($visitorCount); ?></strong>
            <p>Pengunjung yang tercatat di bulan terpilih.</p>
        </div>
    </div>

    <div class="card chart-card">
        <div class="chart-header">
            <div>
                <h3>Grafik Pengunjung</h3>
                <p>Sumbu X menampilkan tanggal 1, 15, dan akhir bulan.</p>
            </div>
            <form method="get" action="<?php echo e(route('admin.dashboard')); ?>">
                <select name="month" onchange="this.form.submit()">
                    <?php $__currentLoopData = $monthOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($option['value']); ?>" <?php echo e($selectedMonth === $option['value'] ? 'selected' : ''); ?>>
                            <?php echo e($option['label']); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </form>
        </div>
        <div class="chart-body">
            <canvas id="visitorChart" height="120"></canvas>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartEl = document.getElementById('visitorChart');
        if (chartEl) {
            const ctx = chartEl.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
                    datasets: [{
                        label: 'Pengunjung',
                        data: <?php echo json_encode($chartData, 15, 512) ?>,
                        borderColor: '#2f5ff7',
                        backgroundColor: 'rgba(47, 95, 247, 0.12)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#2f5ff7'
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>