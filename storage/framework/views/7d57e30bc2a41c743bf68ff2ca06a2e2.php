<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Color Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/spectrum.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4 mt-0">
        <div class="col-xl-6 col-lg-6 mt-0">
            <div class="col-12 mt-5">
                <div class="dashboard__card bg__white padding-20 radius-10">
                   <h2 class="dashboard__card__header__title mb-3"><?php echo e(__("Color Settings")); ?></h2>
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
                        <form action="<?php echo e(route('admin.general.color.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form__input__flex">
                                <div class="form__input__single">
                                    <label for="site_main_color_one"  class="form__input__single__label"><?php echo e(__('Site Main Color One')); ?></label>
                                    <input type="text" name="site_main_color_one" style="background-color: <?php echo e(get_static_option('site_main_color_one')); ?>;" class="form__control radius-5 spectrum_picker"
                                           value="<?php echo e(get_static_option('site_main_color_one')); ?>" id="site_main_color_one">
                                    <br>
                                    <small class="form-text text-muted"><?php echo e(__('you can change -site main color- from here, it will replace the website main color')); ?></small>
                                </div>

                                <div class="fform__input__single">
                                    <label for="site_main_color_two" class="form__input__single__label"><?php echo e(__('Site Main Color Two')); ?></label>
                                    <input type="text" name="site_main_color_two" style="background-color: <?php echo e(get_static_option('site_main_color_two')); ?>;" class="form__control radius-5 spectrum_picker"
                                           value="<?php echo e(get_static_option('site_main_color_two')); ?>" id="site_main_color_two">
                                    <br>
                                    <small class="form-text text-muted"><?php echo e(__('you can change -site base color- from here, it will replace the website base color')); ?></small>
                                </div>

                                <div class="form__input__single">
                                    <label for="site_main_color_three" class="form__input__single__label"><?php echo e(__('Site Main Color Three')); ?></label>
                                    <input type="text" name="site_main_color_three" style="background-color: <?php echo e(get_static_option('site_main_color_three')); ?>;" class="form__control radius-5 spectrum_picker"
                                           value="<?php echo e(get_static_option('site_main_color_three')); ?>" id="site_main_color_three">
                                    <br>
                                    <small class="form-text text-muted"><?php echo e(__('you can change -site base color- from here, it will replace the website base color')); ?></small>
                                </div>

                                <div class="form__input__single">
                                    <label for="heading_color" class="form__input__single__label"><?php echo e(__('Heading Color')); ?></label>
                                    <input type="text" name="heading_color" style="background-color: <?php echo e(get_static_option('heading_color')); ?>;" class="form__control radius-5 spectrum_picker"
                                           value="<?php echo e(get_static_option('heading_color')); ?>" id="heading_color">
                                    <br>
                                    <small class="form-text text-muted"><?php echo e(__('you can change -heading color- from here, it will replace the website base color')); ?></small>
                                </div>

                                <div class="form__input__single">
                                    <label for="light_color" class="form__input__single__label"><?php echo e(__('Light Color')); ?></label>
                                    <input type="text" name="light_color" style="background-color: <?php echo e(get_static_option('light_color')); ?>;" class="form__control radius-5 spectrum_picker"
                                           value="<?php echo e(get_static_option('light_color')); ?>" id="light_color">
                                    <br>
                                    <small class="form-text text-muted"><?php echo e(__('you can change -heading color- from here, it will replace the website base color')); ?></small>
                                </div>

                                <div class="form__input__single">
                                    <label for="extra_light_color" class="form__input__single__label"> <?php echo e(__('Extra Light Color')); ?></label>
                                    <input type="text" name="extra_light_color" style="background-color: <?php echo e(get_static_option('extra_light_color')); ?>;" class="form__control radius-5 spectrum_picker"
                                           value="<?php echo e(get_static_option('extra_light_color')); ?>" id="extra_light_color">
                                    <br>
                                    <small class="form-text text-muted"><?php echo e(__('you can change -heading color- from here, it will replace the website base color')); ?></small>
                                </div>
                            </div>
                            <div class="btn_wrapper mt-4">
                                <button type="submit" id="update" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Update Changes')); ?></button>
                            </div>
                        </form>
                 </div>
           </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/spectrum.min.js')); ?>"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginal26b641e1adcfef4e774221a3ed7c52ce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.update','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce)): ?>
<?php $attributes = $__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce; ?>
<?php unset($__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26b641e1adcfef4e774221a3ed7c52ce)): ?>
<?php $component = $__componentOriginal26b641e1adcfef4e774221a3ed7c52ce; ?>
<?php unset($__componentOriginal26b641e1adcfef4e774221a3ed7c52ce); ?>
<?php endif; ?>
                colorPickerInit($('.spectrum_picker'))
                function colorPickerInit(selector){
                    $.each(selector,function (index,value){
                        var el = $(this);
                        el.spectrum({
                            preferredFormat: "hex",
                            showAlpha: true,
                            showPalette: true,
                            cancelText : '',
                            showInput: true,
                            allowEmpty:true,
                            chooseText : '',
                            maxSelectionSize: 2,
                            color: el.val(),
                            change: function(color) {
                                el.val( color ? color.toRgbString() : '');
                                el.css({
                                    'background-color' : color ? color.toRgbString() : ''
                                });
                            },
                            move: function(color) {
                                el.val( color ? color.toRgbString() : '');
                                el.css({
                                    'background-color' : color ? color.toRgbString() : ''
                                });
                            }
                        });

                        el.on("dragstop.spectrum", function(e, color) {
                            el.val( color.toRgbString());
                            el.css({
                                'background-color' : color.toHexString()
                            });
                        });
                    });
                }

            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/resources/views/backend/general-settings/color-settings.blade.php ENDPATH**/ ?>