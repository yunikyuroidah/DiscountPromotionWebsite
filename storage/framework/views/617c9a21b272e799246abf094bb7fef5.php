<?php if($paginator->hasPages()): ?>
    <nav class="pager" role="navigation">
        <?php if($paginator->onFirstPage()): ?>
            <span class="pager-link disabled">Sebelumnya</span>
        <?php else: ?>
            <a class="pager-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">Sebelumnya</a>
        <?php endif; ?>

        <span class="pager-info">Halaman <?php echo e($paginator->currentPage()); ?> dari <?php echo e($paginator->lastPage()); ?></span>

        <?php if($paginator->hasMorePages()): ?>
            <a class="pager-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">Berikutnya</a>
        <?php else: ?>
            <span class="pager-link disabled">Berikutnya</span>
        <?php endif; ?>
    </nav>
<?php endif; ?>
<?php /**PATH D:\laragon\www\DiscountPromotionWebsite\resources\views/partials/pagination.blade.php ENDPATH**/ ?>