<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $__env->yieldContent('title', 'Admin PromoDiskon'); ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php echo $__env->yieldPushContent('head'); ?>
    </head>
    <body class="page-admin" data-page="admin">
        <?php
            $adminUser = \App\Models\Admin::find(session('admin_id'));
            $adminName = $adminUser?->name ?? 'Admin';
        ?>
        <div class="admin-shell">
            <aside class="admin-sidebar">
                <div class="admin-sidebar-top">
                    <div class="admin-brand-wrap">
                        <div class="admin-brand">PromoDiskon</div>
                        <div class="admin-subtitle">Panel Admin</div>
                    </div>
                    <nav class="admin-nav">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard*') ? 'active' : ''); ?>">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="<?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Data Barang
                        </a>
                        <a href="<?php echo e(route('admin.visitors.index')); ?>" class="<?php echo e(request()->routeIs('admin.visitors.*') ? 'active' : ''); ?>">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Riwayat Pengunjung
                        </a>
                    </nav>
                </div>
                <div class="admin-sidebar-footer">
                    <div class="admin-user-info">
                        <div class="admin-avatar-sm"><?php echo e(strtoupper(substr($adminName, 0, 1))); ?></div>
                        <div class="admin-user-detail">
                            <span class="admin-user-name"><?php echo e($adminName); ?></span>
                            <span class="admin-user-role">Administrator</span>
                        </div>
                    </div>
                    <div class="admin-footer-actions">
                        <a class="btn-sidebar-action btn-sidebar-home" href="<?php echo e(route('home')); ?>">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Beranda
                        </a>
                        <form method="post" action="<?php echo e(route('admin.logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-sidebar-action btn-sidebar-logout">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
            <div class="admin-content">
                <header class="admin-topbar">
                    <div>
                        <h1><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                        <p><?php echo $__env->yieldContent('page-desc', 'Ringkasan promosi dan pengunjung.'); ?> </p>
                    </div>
                    <div class="admin-user">
                        <div class="admin-avatar"><?php echo e(strtoupper(substr($adminName, 0, 1))); ?></div>
                        <div>
                            <div class="admin-name"><?php echo e($adminName); ?></div>
                            <div class="admin-role">Administrator</div>
                        </div>
                    </div>
                </header>
                <section class="admin-body">
                    <?php echo $__env->yieldContent('content'); ?>
                </section>
            </div>
        </div>
        <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/layouts/admin.blade.php ENDPATH**/ ?>