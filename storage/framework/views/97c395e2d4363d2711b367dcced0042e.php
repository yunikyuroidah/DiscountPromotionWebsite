

<?php $__env->startSection('title', 'Beranda - PromoDiskon'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $formatRupiah = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.');
        $heroEndsAt = $heroProduct?->discount_valid_until;
    ?>

    <section class="hero container">
        <div class="hero-copy reveal" style="--delay: 0.05s">
            <span class="pill">Promo elektronik pilihan</span>
            <h1>Diskon gadget favorit dengan tampilan rapi dan profesional.</h1>
            <p>Temukan promo terbaru untuk perangkat audio, wearable, dan aksesoris elektronik. Semua informasi dibuat jelas seperti brosur diskon versi digital.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="<?php echo e(route('promo')); ?>">Lihat Promo</a>
                <a class="btn btn-ghost" href="#produk-terbaru">Produk Terbaru</a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-value"><?php echo e($featuredProducts->count()); ?></div>
                    <div class="stat-label">Promo Unggulan</div>
                </div>
                <div class="stat">
                    <div class="stat-value"><?php echo e($latestProducts->count()); ?></div>
                    <div class="stat-label">Produk Baru</div>
                </div>
                <div class="stat">
                    <div class="stat-value">30+</div>
                    <div class="stat-label">Brand Terpercaya</div>
                </div>
            </div>
        </div>
        <div class="hero-card reveal" style="--delay: 0.15s">
            <?php if($heroProduct): ?>
                <div class="hero-card-head">
                    <span class="badge">Diskon <?php echo e($heroProduct->discount_percent); ?>%</span>
                    <span class="muted">Berlaku sampai <?php echo e($heroEndsAt ? $heroEndsAt->format('d-m-Y') : '-'); ?></span>
                </div>
                <div class="hero-product-image">
                    <img src="<?php echo e(route('product.image', $heroProduct)); ?>" alt="<?php echo e($heroProduct->name); ?>" class="float">
                </div>
                <div class="hero-card-body">
                    <h3><?php echo e($heroProduct->name); ?></h3>
                    <p class="muted"><?php echo e($heroProduct->brand); ?> | <?php echo e($heroProduct->category ?? 'Elektronik'); ?></p>
                    <div class="price-row">
                        <?php if($heroProduct->is_discount_active): ?>
                            <span class="price-old"><?php echo e($formatRupiah($heroProduct->price)); ?></span>
                        <?php endif; ?>
                        <span class="price"><?php echo e($formatRupiah($heroProduct->discounted_price)); ?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class="hero-card-body">
                    <h3>Produk unggulan segera hadir</h3>
                    <p class="muted">Tambahkan produk di panel admin untuk menampilkan promo di sini.</p>
                    <a class="btn btn-primary" href="<?php echo e(route('admin.login')); ?>">Masuk Admin</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Kategori</span>
                    <h2>Jelajahi berdasarkan kategori</h2>
                </div>
            </div>
            <div class="category-grid">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a
                        class="category-card tone-<?php echo e(($loop->index % 5) + 1); ?> reveal"
                        style="--delay: 0.1s"
                        href="<?php echo e(route('promo', ['category' => $category])); ?>"
                    >
                        <span><?php echo e($category); ?></span>
                        <small>Lihat promo</small>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php
                        $fallbackCategories = ['Audio', 'Wearable', 'Power', 'Aksesori', 'Kitchen'];
                    ?>
                    <?php $__currentLoopData = $fallbackCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fallback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="category-card tone-<?php echo e(($loop->index % 5) + 1); ?>" href="<?php echo e(route('promo', ['category' => $fallback])); ?>">
                            <span><?php echo e($fallback); ?></span>
                            <small>Lihat promo</small>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Promo Unggulan</span>
                    <h2>Diskon terbaik minggu ini</h2>
                </div>
                <a class="btn btn-ghost" href="<?php echo e(route('promo')); ?>">Semua Promo</a>
            </div>
            <div class="product-grid">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="product-card reveal" style="--delay: 0.1s">
                        <div class="product-media">
                            <img src="<?php echo e(route('product.image', $product)); ?>" alt="<?php echo e($product->name); ?>">
                            <?php if($product->is_discount_active): ?>
                                <span class="badge badge-floating">-<?php echo e($product->discount_percent); ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <span class="product-brand"><?php echo e($product->brand); ?></span>
                            <h3><?php echo e($product->name); ?></h3>
                            <p class="muted"><?php echo e($product->category ?? 'Elektronik'); ?></p>
                            <div class="price-row">
                                <?php if($product->is_discount_active): ?>
                                    <span class="price-old"><?php echo e($formatRupiah($product->price)); ?></span>
                                <?php endif; ?>
                                <span class="price"><?php echo e($formatRupiah($product->discounted_price)); ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="promo-banner reveal" style="--delay: 0.05s">
                <div>
                    <span class="section-eyebrow">Promo Spesial</span>
                    <h2>Upgrade pengalaman musik dan produktivitas.</h2>
                    <p>Dapatkan diskon ekstra untuk produk pilihan minggu ini.</p>
                </div>
                <div class="promo-banner-action">
                    <a class="btn btn-primary" href="<?php echo e(route('promo')); ?>">Cek Promo</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="produk-terbaru">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Produk Terbaru</span>
                    <h2>Rekomendasi untukmu</h2>
                </div>
                <a class="btn btn-ghost" href="<?php echo e(route('promo')); ?>">Lihat Semua</a>
            </div>
            <div class="product-grid">
                <?php $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="product-card reveal" style="--delay: 0.1s">
                        <div class="product-media">
                            <img src="<?php echo e(route('product.image', $product)); ?>" alt="<?php echo e($product->name); ?>">
                            <?php if($product->is_discount_active): ?>
                                <span class="badge badge-floating">-<?php echo e($product->discount_percent); ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <span class="product-brand"><?php echo e($product->brand); ?></span>
                            <h3><?php echo e($product->name); ?></h3>
                            <p class="muted"><?php echo e($product->category ?? 'Elektronik'); ?></p>
                            <div class="price-row">
                                <?php if($product->is_discount_active): ?>
                                    <span class="price-old"><?php echo e($formatRupiah($product->price)); ?></span>
                                <?php endif; ?>
                                <span class="price"><?php echo e($formatRupiah($product->discounted_price)); ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/public/home.blade.php ENDPATH**/ ?>