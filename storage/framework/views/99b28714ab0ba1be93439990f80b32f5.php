<?php if(session()->has('msg')): ?>
    <div class="alert alert-danger alert-<?php echo e(session('type')); ?>">
        <?php echo session('msg'); ?>

    </div>
<?php endif; ?>
<?php /**PATH /home/tutreqhl/public_html/core/resources/views/components/msg/flash-msg.blade.php ENDPATH**/ ?>