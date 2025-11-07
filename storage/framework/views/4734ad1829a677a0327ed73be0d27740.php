<?php $__env->startSection('site_title'); ?>
    <?php echo e(__('Email Verify')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="loginArea section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 login-Wrapper">
                   <div class="text-center mb-3">
                       <h3 class="tittle"><?php echo e(__('Verify Your Account')); ?></h3>
                       <div class="alert alert-info alert-bs-dismissible fade show mt-5 mb-1 mx-auto d-inline-block" role="alert">
                           <?php echo e(__('Please check email inbox/spam for verification code')); ?>

                       </div>
                   </div>
                    <?php if (isset($component)) { $__componentOriginalc04996af13f0d779852114b39ea43e16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04996af13f0d779852114b39ea43e16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.frontend-error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('validation.frontend-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04996af13f0d779852114b39ea43e16)): ?>
<?php $attributes = $__attributesOriginalc04996af13f0d779852114b39ea43e16; ?>
<?php unset($__attributesOriginalc04996af13f0d779852114b39ea43e16); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04996af13f0d779852114b39ea43e16)): ?>
<?php $component = $__componentOriginalc04996af13f0d779852114b39ea43e16; ?>
<?php unset($__componentOriginalc04996af13f0d779852114b39ea43e16); ?>
<?php endif; ?>
                    <form action="<?php echo e(route('email.verify')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                          <div class="col-12">
                              <label class="infoTitle"><?php echo e(__('First Name')); ?></label>
                              <div class="input-form input-form2">
                                  <input type="text" name="email_verify_token" placeholder="<?php echo e(__('Enter code')); ?>">
                              </div>
                          </div>
                       </div>
                        <div class="col-12">
                            <div class="btn-wrapper text-center mt-50">
                                <button type="submit" class="cmn-btn4 w-100 mb-60 verify-account"><?php echo e(__('Verify Account')); ?></button>
                            </div>
                        </div>
                    </form>
                    <!--Reset code -->
                    <div class="resend-verify-code-wrap mt-3 text-center">
                        <a  class="text-center" href="<?php echo e(route('resend.verify.code')); ?>"><strong><?php echo e(__('Resend Code')); ?></strong></a>
                    </div>
                </div>
           </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/resources/views/frontend/user/email-verify.blade.php ENDPATH**/ ?>