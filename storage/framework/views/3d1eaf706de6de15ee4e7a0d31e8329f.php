<div class="modal fade" id="editTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo e(__('Edit Type')); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.membership.type.edit')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="type_id" id="type_id" value="">
                <div class="modal-body">
                    <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Type'),'type' => __('text'),'name' => 'type','id' => 'edit_type','value' => '','placeholder' => __('Enter membership type')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Type')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('text')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('type'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('edit_type'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter membership type'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $attributes = $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $component = $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.number','data' => ['title' => __('Validity'),'min' => 7,'max' => 365,'name' => 'validity','id' => 'edit_validity','divClass' => 'mb-0','value' => '','placeholder' => __('Enter validity')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.number'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Validity')),'min' => 7,'max' => 365,'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('validity'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('edit_validity'),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter validity'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484)): ?>
<?php $attributes = $__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484; ?>
<?php unset($__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484)): ?>
<?php $component = $__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484; ?>
<?php unset($__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484); ?>
<?php endif; ?>
                    <p class="text-info"><?php echo e(__('Validity must be a number between 7 to 365 days')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <div class="btn_wrapper mt-4">
                        <button type="submit" id="update" class="cmnBtn btn_5 btn_bg_blue radius-5 edit_type"><?php echo e(__('Update')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /home/tutreqhl/public_html/core/Modules/Membership/resources/views/backend/type/edit-modal.blade.php ENDPATH**/ ?>