<table class="dataTablesExample">
    <thead>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag-bulk-delete')): ?>
        <th class="no-sort">
            <div class="mark-all-checkbox">
                <input type="checkbox" class="all-checkbox">
            </div>
        </th>
    <?php endif; ?>
    <th><?php echo e(__('ID')); ?></th>
    <th><?php echo e(__('Name')); ?></th>
    <th><?php echo e(__('Status')); ?></th>
    <th><?php echo e(__('Action')); ?></th>
    </thead>
    <tbody>
    <?php if(!empty($all_tags) && $all_tags->count()): ?>
        <?php $__currentLoopData = $all_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag-bulk-delete')): ?>
                    <td>
                        <div class="bulk-checkbox-wrapper">
                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="<?php echo e($data->id); ?>">
                        </div>
                    </td>
                <?php endif; ?>
                <td><?php echo e($data->id); ?></td>
                <td><?php echo e($data->name); ?></td>
                <td>
                    <?php if($data->status == 'draft'): ?>
                        <span class="alert alert-primary" ><?php echo e(__('Draft')); ?></span>
                    <?php else: ?>
                        <span class="alert alert-success" ><?php echo e(__('Publish')); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag-bulk-delete')): ?>
                        <?php if (isset($component)) { $__componentOriginal0d086c76bb3005df8f0c13f4bb5ba4b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0d086c76bb3005df8f0c13f4bb5ba4b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.languages.delete-popover-all-lang','data' => ['url' => route('admin.blog.tags.delete.all.lang',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('languages.delete-popover-all-lang'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.blog.tags.delete.all.lang',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0d086c76bb3005df8f0c13f4bb5ba4b8)): ?>
<?php $attributes = $__attributesOriginal0d086c76bb3005df8f0c13f4bb5ba4b8; ?>
<?php unset($__attributesOriginal0d086c76bb3005df8f0c13f4bb5ba4b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0d086c76bb3005df8f0c13f4bb5ba4b8)): ?>
<?php $component = $__componentOriginal0d086c76bb3005df8f0c13f4bb5ba4b8; ?>
<?php unset($__componentOriginal0d086c76bb3005df8f0c13f4bb5ba4b8); ?>
<?php endif; ?>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag-edit')): ?>
                        <a href="#"
                           data-bs-toggle="modal"
                           data-bs-target="#category_edit_modal"
                           class="btn btn-lg btn-primary btn-sm category_edit_btn"
                           data-id="<?php echo e($data->id); ?>"
                           data-name="<?php echo e($data->name); ?>"
                           data-status="<?php echo e($data->status); ?>"
                           data-slug="<?php echo e($data->slug); ?>">
                            <i class="ti-pencil"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <span><?php echo e(__('Tag No Found')); ?></span>
    <?php endif; ?>
    </tbody>
</table>
<div class="custom_pagination mt-5 d-flex justify-content-end">
    <?php echo e($all_tags->links()); ?>

</div>
<?php /**PATH /home/tutreqhl/public_html/core/Modules/Blog/resources/views/backend/tags/search-tags.blade.php ENDPATH**/ ?>