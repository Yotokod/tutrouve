<div class="modal fade" id="editPaymentGatewayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo e(__('Complete Payment Status')); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.user.membership.update.manual.payment')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="membership_id" id="membership_id">
                <input type="hidden" name="user_firstname" id="user_firstname">
                <input type="hidden" name="user_email" id="user_email">
                <div class="modal-body">
                    <h4><?php echo e(__('User Details')); ?></h4>

                    <div class="mt-2">
                        <p><?php echo e(__('User Name:')); ?> <span class="user_firstname"></span></p>
                        <p><?php echo e(__('User Email:')); ?> <span class="user_email"></span></p>
                    </div>

                    <p><?php echo e(__('Payment Image:')); ?>

                        <img class="manual_payment_img" src="" alt="<?php echo e(__('Manual Payment Image')); ?>">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <?php if (isset($component)) { $__componentOriginal632b1038db5541c1a915a7b91a4b9d06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal632b1038db5541c1a915a7b91a4b9d06 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit-btn','data' => ['title' => __('Update'),'class' => 'btn btn-primary mt-4 pr-4 pl-4 update_category']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.submit-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Update')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn btn-primary mt-4 pr-4 pl-4 update_category')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal632b1038db5541c1a915a7b91a4b9d06)): ?>
<?php $attributes = $__attributesOriginal632b1038db5541c1a915a7b91a4b9d06; ?>
<?php unset($__attributesOriginal632b1038db5541c1a915a7b91a4b9d06); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal632b1038db5541c1a915a7b91a4b9d06)): ?>
<?php $component = $__componentOriginal632b1038db5541c1a915a7b91a4b9d06; ?>
<?php unset($__componentOriginal632b1038db5541c1a915a7b91a4b9d06); ?>
<?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /home/tutreqhl/public_html/core/Modules/Membership/resources/views/backend/user-membership/manual-payment-modal.blade.php ENDPATH**/ ?>