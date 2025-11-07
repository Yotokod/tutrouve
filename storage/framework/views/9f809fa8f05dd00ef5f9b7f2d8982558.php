<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('GDPR Compliant Cookie Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        input.form__control.gdpr_color_style {
            background-color: #ffff;
        }
        textarea.form__control.max-height-120.gdpr_color_style {
            background-color: #ffff;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4 mt-0">
        <div class="col-xl-12 col-lg-12 mt-0">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <h2 class="dashboard__card__header__title mb-3"><?php echo e(__('GDPR Compliant Cookie Settings')); ?></h2>
                <?php if (isset($component)) { $__componentOriginal4bb59b834d778ff0cb72af5a473e2885 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('validation.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $attributes = $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $component = $__componentOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
                <form action="<?php echo e(route('admin.general.gdpr.settings')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form__input__flex">
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_title" class="form__input__single__label"><?php echo e(__('GDPR Title')); ?></label>
                            <input type="text" class="form__control radius-5" name="site_gdpr_cookie_title" id="site_gdpr_cookie_title" value="<?php echo e(get_static_option('site_gdpr_cookie_title')); ?>">
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_message" class="form__input__single__label"><?php echo e(__('GDPR Message')); ?></label>
                            <textarea class="form__control" name="site_gdpr_cookie_message" id="site_gdpr_cookie_message"><?php echo e(get_static_option('site_gdpr_cookie_message')); ?></textarea>
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_more_info_label" class="form__input__single__label"><?php echo e(__('GDPR More Info Link Label')); ?></label>
                            <input type="text" name="site_gdpr_cookie_more_info_label"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_more_info_label')); ?>" id="site_gdpr_cookie_more_info_label">
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_more_info_link" class="form__input__single__label"><?php echo e(__('GDPR More Info Link')); ?></label>
                            <input type="text" name="site_gdpr_cookie_more_info_link"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_more_info_link')); ?>" id="site_gdpr_cookie_more_info_link">
                            <small class="form-text text-muted"><?php echo e(__('enter more info link user {url} to point the site address, example: {url}/about , it will be converted to www.yoursite.com/about')); ?></small>
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_accept_button_label" class="form__input__single__label"><?php echo e(__('GDPR Cookie Accept Button Label')); ?></label>
                            <input type="text" name="site_gdpr_cookie_accept_button_label"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_accept_button_label')); ?>" id="site_gdpr_cookie_accept_button_label">
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_decline_button_label" class="form__input__single__label"><?php echo e(__('GDPR Cookie Decline Button Label')); ?></label>
                            <input type="text" name="site_gdpr_cookie_decline_button_label"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_decline_button_label')); ?>" id="site_gdpr_cookie_decline_button_label">
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_manage_button_label" class="form__input__single__label"><?php echo e(__('GDPR Cookie Manage Button Label')); ?></label>
                            <input type="text" name="site_gdpr_cookie_manage_button_label"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_manage_button_label')); ?>" >
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_manage_title" class="form__input__single__label"><?php echo e(__('GDPR Cookie Manage Title')); ?></label>
                            <input type="text" name="site_gdpr_cookie_manage_title"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_manage_title')); ?>" >
                        </div>

                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_enabled" class="form__input__single__label"><strong><?php echo e(__('GDPR Cookie Enable/Disable')); ?></strong></label> <br>
                            <label class="switch_box style_7">
                                <input type="checkbox" name="site_gdpr_cookie_enabled"  <?php if(!empty(get_static_option('site_gdpr_cookie_enabled'))): ?> checked <?php endif; ?> id="site_gdpr_cookie_enabled">
                                <label></label>
                            </label>
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_expire" class="form__input__single__label"><?php echo e(__('Cookie Expire')); ?></label>
                            <input type="text" name="site_gdpr_cookie_expire"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_expire')); ?>" id="site_gdpr_cookie_expire">
                            <small class="form-text text-muted"><?php echo e(__('set cookie expire time, eg: 30, means 30days')); ?></small>
                        </div>
                        <div class="form__input__single">
                            <label for="site_gdpr_cookie_delay" class="form__input__single__label"><?php echo e(__('Show Delay')); ?></label>
                            <input type="text" name="site_gdpr_cookie_delay"  class="form__control" value="<?php echo e(get_static_option('site_gdpr_cookie_delay')); ?>" id="site_gdpr_cookie_delay">
                            <small class="form-text text-muted"><?php echo e(__('set GDPR cookie delay time, it mean the notification will show after this time. number count as mili seconds. eg: 5000, means 5seconds')); ?></small>
                        </div>
                        <?php
                            $all_title_fields = get_static_option('site_gdpr_cookie_manage_item_title');
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [''];
                            $all_description_fields = get_static_option('site_gdpr_cookie_manage_item_description');
                            $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [''];
                        ?>
                        <?php $__currentLoopData = $all_title_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form__input__single">
                                <div class="all-field-wrap">
                                    <div class="form__input__single">
                                        <label for="site_gdpr_cookie_manage_item_title" class="gdpr_title_text_color form__input__single__label"><?php echo e(__('Title')); ?></label>
                                        <input type="text" name="site_gdpr_cookie_manage_item_title[]" class="form__control gdpr_color_style" value="<?php echo e($all_title_fields[$index] ?? ''); ?>">
                                    </div>
                                    <div class="form__input__single">
                                        <label for="site_gdpr_cookie_manage_item_description" class="gdpr_title_text_color form__input__single__label"><?php echo e(__('Description')); ?></label>
                                        <textarea name="site_gdpr_cookie_manage_item_description[]" class="form__control max-height-120 gdpr_color_style" cols="30" rows="5"><?php echo e($all_description_fields[$index] ?? ''); ?></textarea>
                                    </div>
                                    <div class="action-wrap">
                                        <span class="add"><i class="ti-plus"></i></span>
                                        <span class="remove"><i class="ti-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="btn_wrapper mt-4">
                        <button type="submit" id="update" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Update Changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).on('click','.all-field-wrap .action-wrap .add',function (e){
            e.preventDefault();
            var el = $(this);
            var parent = el.parent().parent();
            var container = $('.all-field-wrap');
            var clonedData = parent.clone();
            var containerLength = container.length;
            clonedData.find('#myTab').attr('id','mytab_'+containerLength);
            clonedData.find('#myTabContent').attr('id','myTabContent_'+containerLength);
            var allTab =  clonedData.find('.tab-pane');
            allTab.each(function (index,value){
                var el = $(this);
                var oldId = el.attr('id');
                el.attr('id',oldId+containerLength);
            });
            var allTabNav =  clonedData.find('.nav-link');
            allTabNav.each(function (index,value){
                var el = $(this);
                var oldId = el.attr('href');
                el.attr('href',oldId+containerLength);
            });

            parent.parent().append(clonedData);

            if (containerLength > 0){
                parent.parent().find('.remove').show(300);
            }
            parent.parent().find('.iconpicker-popover').remove();
            parent.parent().find('.icp-dd').iconpicker();

        });

        $(document).on('click','.all-field-wrap .action-wrap .remove',function (e){
            e.preventDefault();
            var el = $(this);
            var parent = el.parent().parent();
            var container = $('.all-field-wrap');

            if (container.length > 1){
                el.show(300);
                parent.hide(300);
                parent.remove();
            }else{
                el.hide(300);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/resources/views/backend/general-settings/gdpr.blade.php ENDPATH**/ ?>