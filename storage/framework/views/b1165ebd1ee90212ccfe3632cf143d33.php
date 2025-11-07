<?php if($all_enquiries->count() > 0): ?>
    <table class="table">
        <thead class="table-light">
        <tr>
            <th><?php echo e(__('Id')); ?></th>
            <th><?php echo e(__('Nom')); ?></th>
            <th><?php echo e(__('Email')); ?></th>
            <th><?php echo e(__('Téléphone')); ?></th>
            <th><?php echo e(__('Méssage')); ?></th>
            <th><?php echo e(__('Created At')); ?></th>
            <th><?php echo e(__('Action')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $all_enquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($data->id); ?></td>
                <td><?php echo e($data->name); ?></td>
                <td><?php echo e($data->email); ?></td>
                <td><?php echo e($data->phone); ?></td>
                <td><?php echo e($data->message); ?></td>
                <td><?php echo e($data->created_at->format('Y-m-d') ?? ''); ?> </td>
                <td class="action-table-cell">
                    <?php if (isset($component)) { $__componentOriginal7973b0ce98592c79f9209abd6e46a09b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7973b0ce98592c79f9209abd6e46a09b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.popup.delete-popup','data' => ['url' => route('user.enquiry.form.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('popup.delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('user.enquiry.form.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7973b0ce98592c79f9209abd6e46a09b)): ?>
<?php $attributes = $__attributesOriginal7973b0ce98592c79f9209abd6e46a09b; ?>
<?php unset($__attributesOriginal7973b0ce98592c79f9209abd6e46a09b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7973b0ce98592c79f9209abd6e46a09b)): ?>
<?php $component = $__componentOriginal7973b0ce98592c79f9209abd6e46a09b; ?>
<?php unset($__componentOriginal7973b0ce98592c79f9209abd6e46a09b); ?>
<?php endif; ?>
                    <?php if(!empty($data->listing)): ?>
                        <div class="btn-wrapper">
                            <a class="cmn-btn2 cmn-btn-info" href="<?php echo e(route('frontend.listing.details', $data->listing?->slug ?? 'x')); ?>" target="_blank"><?php echo e(__('Voir l\'annonce')); ?></a>
                        </div>
                    <?php else: ?>
                        <span><?php echo e(__('Pas encore d\'annonce')); ?></span>
                    <?php endif; ?>
                </td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="deposit-history-pagination mt-4">
        <?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_enquiries]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_enquiries)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $attributes = $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $component = $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
    </div>
<?php else: ?>
    <?php if (isset($component)) { $__componentOriginal3f9c527cb64b91d88649358c43ef5eb0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3f9c527cb64b91d88649358c43ef5eb0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.empty-data-placeholder','data' => ['title' => __('Aucune demande pour le moment')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination.empty-data-placeholder'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Aucune demande pour le moment'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3f9c527cb64b91d88649358c43ef5eb0)): ?>
<?php $attributes = $__attributesOriginal3f9c527cb64b91d88649358c43ef5eb0; ?>
<?php unset($__attributesOriginal3f9c527cb64b91d88649358c43ef5eb0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3f9c527cb64b91d88649358c43ef5eb0)): ?>
<?php $component = $__componentOriginal3f9c527cb64b91d88649358c43ef5eb0; ?>
<?php unset($__componentOriginal3f9c527cb64b91d88649358c43ef5eb0); ?>
<?php endif; ?>
<?php endif; ?>

<?php /**PATH /home/tutreqhl/public_html/core/Modules/Membership/resources/views/frontend/user/enquiry/search-result.blade.php ENDPATH**/ ?>