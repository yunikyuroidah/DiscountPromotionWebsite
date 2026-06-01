

<?php $__env->startSection('title', 'Data Barang - PromoDiskon'); ?>
<?php $__env->startSection('page-title', 'Data Barang'); ?>
<?php $__env->startSection('page-desc', 'Kelola data promo dan informasi produk.'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $formatRupiah = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.');
    ?>

    <?php if(session('success')): ?>
        <div class="alert success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="toolbar">
        <form class="filter-bar" method="get" action="<?php echo e(route('admin.products.index')); ?>">
            <input type="text" name="q" placeholder="Cari nama, brand, kategori" value="<?php echo e(request('q')); ?>">
            <select name="category">
                <option value="">Semua Kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category); ?>" <?php echo e(request('category') === $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="discount">
                <option value="">Semua Diskon</option>
                <option value="aktif" <?php echo e(request('discount') === 'aktif' ? 'selected' : ''); ?>>Diskon Aktif</option>
                <option value="habis" <?php echo e(request('discount') === 'habis' ? 'selected' : ''); ?>>Diskon Habis</option>
            </select>
            <input type="number" name="min_price" placeholder="Harga min" value="<?php echo e(request('min_price')); ?>">
            <input type="number" name="max_price" placeholder="Harga max" value="<?php echo e(request('max_price')); ?>">
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
        <a class="btn btn-primary" href="<?php echo e(route('admin.products.create')); ?>">Tambah Barang</a>
    </div>

    <div class="table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Brand</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Diskon (%)</th>
                    <th>Masa Diskon</th>
                    <th>Harga Setelah Diskon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="table-product">
                                <img src="<?php echo e(route('product.image', $product)); ?>" alt="<?php echo e($product->name); ?>">
                                <div>
                                    <div class="table-product-name"><?php echo e($product->name); ?></div>
                                    <div class="muted"><?php echo e($product->category ?? 'Elektronik'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e($product->brand); ?></td>
                        <td><?php echo e($product->weight_grams); ?> g</td>
                        <td><?php echo e($formatRupiah($product->price)); ?></td>
                        <td><?php echo e($product->discount_percent); ?>%</td>
                        <td><?php echo e($product->discount_valid_until ? $product->discount_valid_until->format('d-m-Y') : '-'); ?></td>
                        <td>
                            <?php if($product->is_discount_active): ?>
                                <span class="price-old"><?php echo e($formatRupiah($product->price)); ?></span>
                            <?php endif; ?>
                            <span class="price"><?php echo e($formatRupiah($product->discounted_price)); ?></span>
                        </td>
                        <td>
                            <span class="status <?php echo e($product->is_active ? 'status-active' : 'status-inactive'); ?>">
                                <?php echo e($product->is_active ? 'Aktif' : 'Nonaktif'); ?>

                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a class="btn btn-ghost" href="<?php echo e(route('admin.products.edit', $product)); ?>">Edit</a>
                                <form method="post" action="<?php echo e(route('admin.products.destroy', $product)); ?>" onsubmit="return confirm('Hapus produk ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <h3>Belum ada produk</h3>
                                <p>Tambahkan produk untuk mulai menampilkan promo.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <?php echo $__env->make('partials.pagination', ['paginator' => $products], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/admin/products/index.blade.php ENDPATH**/ ?>