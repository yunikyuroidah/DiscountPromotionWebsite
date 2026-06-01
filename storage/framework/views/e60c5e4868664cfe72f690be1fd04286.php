<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Admin - PromoDiskon</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="page-auth">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-brand">PromoDiskon Admin</div>
                <p>Masuk untuk mengelola promo dan data produk.</p>

                <?php if($errors->any()): ?>
                    <div class="alert danger">
                        <strong>Gagal login.</strong>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo e(route('admin.login.submit')); ?>" class="auth-form">
                    <?php echo csrf_field(); ?>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="admin@promo.local" required>

                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Masukkan password" required>

                    <button type="submit" class="btn btn-primary btn-full">Masuk</button>
                </form>
                <a class="btn btn-ghost btn-full" href="<?php echo e(route('home')); ?>">Kembali ke Beranda</a>
            </div>
        </div>
    </body>
</html>
<?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/admin/login.blade.php ENDPATH**/ ?>