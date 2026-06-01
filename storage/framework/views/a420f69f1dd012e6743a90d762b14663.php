<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $__env->yieldContent('title', 'PromoDiskon Elektronik'); ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="page-public" data-page="public">
        <div class="page-bg"></div>
        <header class="site-header">
            <div class="container nav-bar">
                <a class="brand" href="<?php echo e(route('home')); ?>">PromoDiskon</a>
                <nav class="nav-links">
                    <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Beranda</a>
                    <a href="<?php echo e(route('promo')); ?>" class="<?php echo e(request()->routeIs('promo') ? 'active' : ''); ?>">Promosi</a>
                </nav>
            </div>
        </header>

        <main class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <footer class="site-footer">
            <div class="container footer-grid">
                <div>
                    <div class="brand brand--footer">PromoDiskon</div>
                    <p>Etalase promo elektronik yang rapi dan informatif. Cek diskon terbaru tanpa checkout atau pembayaran.</p>
                </div>
                <div>
                    <h4>Menu</h4>
                    <a href="<?php echo e(route('home')); ?>">Beranda</a>
                    <a href="<?php echo e(route('promo')); ?>">Promosi</a>
                </div>
                <div>
                    <h4>Kontak</h4>
                    <p>Customer Care: (021) 555-2468</p>
                    <p>Email: halo@promodiskon.id</p>
                    <p>Jam operasional: 09.00 - 18.00 WIB</p>
                    <p>Jl. Cendana Raya No. 88, Jakarta</p>
                </div>
            </div>
            <div class="container footer-bottom">Copyright 2026 PromoDiskon. All rights reserved.</div>
        </footer>
    </body>
</html>
<?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/layouts/public.blade.php ENDPATH**/ ?>