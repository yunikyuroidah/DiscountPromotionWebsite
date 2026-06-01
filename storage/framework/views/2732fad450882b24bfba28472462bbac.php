

<?php $__env->startSection('title', 'Promosi - PromoDiskon'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $formatRupiah = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.');
    ?>

    <section class="promo-hero">
        <div class="container">
            <span class="section-eyebrow">Promosi</span>
            <h1>Semua promo elektronik dalam satu halaman.</h1>
            <p>Filter berdasarkan kategori atau diskon aktif untuk menemukan penawaran terbaik.</p>

            <form class="filter-bar" method="get" action="<?php echo e(route('promo')); ?>">
                <input type="text" name="q" placeholder="Cari nama atau brand" value="<?php echo e(request('q')); ?>">
                <select name="category">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category); ?>" <?php echo e(request('category') === $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <select name="discount">
                    <option value="">Semua Diskon</option>
                    <option value="aktif" <?php echo e(request('discount') === 'aktif' ? 'selected' : ''); ?>>Diskon Aktif</option>
                </select>
                <button class="btn btn-primary" type="submit">Terapkan</button>
            </form>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="product-grid">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="product-card reveal" style="--delay: 0.08s">
                        <div class="product-media">
                            <img src="<?php echo e(route('product.image', $product)); ?>" alt="<?php echo e($product->name); ?>">
                            <?php if($product->is_discount_active): ?>
                                <span class="badge badge-floating">-<?php echo e($product->discount_percent); ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <span class="product-brand"><?php echo e($product->brand); ?></span>
                            <h3><?php echo e($product->name); ?></h3>
                            <p class="muted"><?php echo e($product->weight_grams); ?> g | <?php echo e($product->category ?? 'Elektronik'); ?></p>
                            <div class="price-row">
                                <?php if($product->is_discount_active): ?>
                                    <span class="price-old"><?php echo e($formatRupiah($product->price)); ?></span>
                                <?php endif; ?>
                                <span class="price"><?php echo e($formatRupiah($product->discounted_price)); ?></span>
                            </div>
                            <div class="promo-meta">
                                <span>Masa berlaku:</span>
                                <strong><?php echo e($product->discount_valid_until ? $product->discount_valid_until->format('d-m-Y') : '-'); ?></strong>
                            </div>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-state">
                        <h3>Produk tidak ditemukan</h3>
                        <p>Coba ubah filter atau kata kunci pencarian.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pagination-wrapper">
                <?php echo $__env->make('partials.pagination', ['paginator' => $products], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/public/promo.blade.php ENDPATH**/ ?>