<?php $__env->startSection('content'); ?>
    <section class="loginForm">
        <div class="loginForm__left__inner desktop-center">
            <div class="loginForm__header">
                <h2 class="loginForm__header__title"><?php echo e(__('Forget Password')); ?></h2>
                <p class="loginForm__header__para mt-3"><?php echo e(__('Hello there, here you can rest you password.')); ?> </p>
            </div>
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
            <div class="loginForm__wrapper mt-4">
                <form action="<?php echo e(route('admin.forget.password')); ?>" class="custom_form" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="single_input">
                        <label class="label_title"><?php echo e(__('Username or Email')); ?></label>
                        <div class="include_icon">
                            <input class="form--control radius-5" type="text" id="username" name="username" placeholder="<?php echo e(__('Username or Email')); ?>">
                            <div class="icon"><span class="material-symbols-outlined"><?php echo e(__('person')); ?></span></div>
                        </div>
                    </div>
                    <div class="btn_wrapper single_input">
                        <button type="submit" id="form_submit" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Send Reset Password Mail')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login-screens', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/resources/views/auth/admin/forget-password.blade.php ENDPATH**/ ?>