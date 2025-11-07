<table class="dataTablesExample">
    <thead>
    <tr>
        <th><?php echo e(__('ID')); ?></th>
        <th><?php echo e(__('Membership Details')); ?></th>
        <th><?php echo e(__('User Details')); ?></th>
        <th><?php echo e(__('Payment Gateway')); ?></th>
        <th><?php echo e(__('Payment Status')); ?></th>
        <th><?php echo e(__('Status')); ?></th>
        <th><?php echo e(__('Purchase Date')); ?></th>
        <th><?php echo e(__('Expire Date')); ?></th>
        <th><?php echo e(__('Action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $all_memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($membership->id); ?></td>
            <td>
                <?php echo e(__('Title:')); ?> <?php echo e(optional($membership->membership)->title); ?> <br>
                <?php if($membership->price == 0): ?>
                    <?php echo e(__('Price:')); ?> <?php echo e(float_amount_with_currency_symbol($membership->initial_price)); ?> <br>
                <?php else: ?>
                    <?php echo e(__('Price:')); ?> <?php echo e(float_amount_with_currency_symbol($membership->price)); ?> <br>
                <?php endif; ?>
                <?php echo e(__('Type:')); ?> <?php echo e($membership->membership?->membership_type?->type); ?> <br>
                <?php echo e(__('Listing Limit:')); ?> <?php echo e($membership->listing_limit); ?> <br>
                <?php echo e(__('Gallery Images Per Listing:')); ?>  <?php echo e($membership->gallery_images); ?> <br>
                <?php echo e(__('Featured Listing:')); ?>  <?php echo e($membership->featured_listing); ?> <br>

                <?php echo e(__('Business Hour:')); ?>

                <?php if($membership->business_hour == 1): ?>
                    <i class="las la-check-circle text-success fs-4 mx-2"></i>
                <?php else: ?>
                    <i class="las la-times-circle text-danger fs-4 mx-2"></i>
                <?php endif; ?>
                <br>

                <?php echo e(__('Enquiry Form:')); ?>

                <?php if($membership->enquiry_form == 1): ?>
                    <i class="las la-check-circle text-success fs-4 mx-2"></i>
                <?php else: ?>
                    <i class="las la-times-circle text-danger fs-4 mx-2"></i>
                <?php endif; ?>
                <br>

                <?php echo e(__('Membership Badge:')); ?>

                <?php if($membership->membership_badge == 1): ?>
                    <i class="las la-check-circle text-success fs-4 mx-2"></i>
                <?php else: ?>
                    <i class="las la-times-circle text-danger fs-4 mx-2"></i>
                <?php endif; ?>
            </td>

            <td>
                <?php echo e(__('Name:')); ?> <?php echo e(optional($membership->user)->fullname); ?> <br>
                <?php echo e(__('Email:')); ?> <?php echo e(optional($membership->user)->email); ?> <br>
                <?php echo e(__('Phone:')); ?> <?php echo e(optional($membership->user)->phone); ?>

            </td>

            <td>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-membership-manual-payment-status-change')): ?>
                    <?php if($membership->payment_gateway == 'manual_payment'): ?>
                        <?php echo e(ucfirst(str_replace('_',' ',$membership->payment_gateway))); ?>

                    <?php else: ?>
                        <?php echo e($membership->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst($membership->payment_gateway)); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if($membership->payment_status == '' || $membership->payment_status == 'cancel'): ?>
                    <span class="btn btn-danger btn-sm"><?php echo e(__('Cancel')); ?></span>
                <?php elseif($membership->payment_status == 'pending'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-membership-manual-payment-status-change')): ?>
                        <span class="btn btn-warning btn-sm"><?php echo e(ucfirst($membership->payment_status)); ?></span>
                        <a class="btn btn-sm btn-success edit_payment_gateway_modal"
                            data-bs-toggle="modal"
                            data-bs-target="#editPaymentGatewayModal"
                            data-membership_id="<?php echo e($membership->id); ?>"
                            data-user_firstname="<?php echo e($membership->user?->fullname); ?>"
                            data-user_email="<?php echo e($membership->user?->email); ?>"
                            data-img_url="<?php echo e($membership->manual_payment_image); ?>">
                            <?php echo e(__('Update')); ?>

                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="btn btn-success btn-sm"><?php echo e(ucfirst($membership->payment_status)); ?></span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($membership->status == 0): ?>
                    <span class="btn btn-danger btn-sm"><?php echo e(__('Inactive')); ?></span>
                <?php else: ?>
                    <span class="btn btn-success btn-sm"><?php echo e(__('Active')); ?></span>
                <?php endif; ?>
            </td>
            <td><?php echo e($membership->created_at->format('Y-m-d') ?? ''); ?></td>
            <td><?php echo e(Carbon\Carbon::parse($membership->expire_date)->format('Y-m-d')); ?></td>
            <td>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-membership-status-change')): ?>
                    <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __('Change Status'),'url' => route('admin.user.membership.status',$membership->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Change Status')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.user.membership.status',$membership->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                <?php endif; ?>
                  <br>
                <a class="cmnBtn btn_5 btn_bg_info radius-5 mt-2" href="<?php echo e(route('admin.user.membership.history',$membership->user_id)); ?>"><?php echo e(__('History')); ?></a>
                <a href="<?php echo e(route('admin.user.membership.email.sent', $membership->id)); ?>" class="cmnBtn btn_5 btn_bg_secondary radius-5 mt-2"><?php echo e(__('Send Email')); ?></a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['route' => $route,'allData' => $all_memberships]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($route),'allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_memberships)]); ?>
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
<?php /**PATH /home/tutreqhl/public_html/core/Modules/Membership/resources/views/backend/user-membership/search-result.blade.php ENDPATH**/ ?>