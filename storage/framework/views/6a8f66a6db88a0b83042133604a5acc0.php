<div class="compare-profile-and-identity">
    <div class="row g-4 gy-5">
        <div class="col-lg-6">
            <div class="user-profile userProfileDetails">
                <div class="userProfileDetails__header">
                    <h5 class="userProfileDetails__title"><?php echo e(__('User Profile Info')); ?></h5>
                    <input type="hidden" id="user_id_for_verified_status" value="<?php echo e($user_details->id); ?>">
                </div>
                <div class="userDetails__wrapper userProfile__details mt-3">
                    <div class="userProfile__details__thumb mb-3"  style="height: 100px;width: 70px">
                        <?php if(!empty($user_details->image)): ?>
                           <?php echo render_image_markup_by_attachment_id($user_details->image, '', 'thumb'); ?>

                         <?php else: ?>
                            <?php if (isset($component)) { $__componentOriginalc1ff17f27b163a217d6db98cc98cfb19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1ff17f27b163a217d6db98cc98cfb19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image.user-no-image','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image.user-no-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1ff17f27b163a217d6db98cc98cfb19)): ?>
<?php $attributes = $__attributesOriginalc1ff17f27b163a217d6db98cc98cfb19; ?>
<?php unset($__attributesOriginalc1ff17f27b163a217d6db98cc98cfb19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1ff17f27b163a217d6db98cc98cfb19)): ?>
<?php $component = $__componentOriginalc1ff17f27b163a217d6db98cc98cfb19; ?>
<?php unset($__componentOriginalc1ff17f27b163a217d6db98cc98cfb19); ?>
<?php endif; ?>
                         <?php endif; ?>
                    </div>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Full Name:')); ?></strong> <?php echo e($user_details->first_name.' '.$user_details->last_name); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Username:')); ?></strong> <?php echo e($user_details->username ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Email:')); ?></strong> <?php echo e($user_details->email ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e($user_details->phone ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Country:')); ?></strong> <?php echo e(optional($user_details->user_country)->country ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('State:')); ?></strong> <?php echo e(optional($user_details->user_state)->state ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('City:')); ?></strong> <?php echo e(optional($user_details->user_city)->city ?? ''); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="user-identity userProfileDetails">
                <div class="userProfileDetails__header">
                    <h5 class="userProfileDetails__title"><?php echo e(__('User Identity Info')); ?></h5>
                </div>
                <div class="userDetails__wrapper userProfile__details mt-3 ">
                    <?php if(!empty($user_identity_details)): ?>
                        <div class="userProfile__details__thumb mb-3 d-flex gap-3">
                            <a class="radius-5" href="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->front_document)); ?>" target="_blank">
                                <?php if(pathinfo($user_identity_details->front_document, PATHINFO_EXTENSION) === 'pdf'): ?>
                                    <a class="btn btn-info radius-5" href="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->front_document)); ?>" target="_blank">
                                        <?php echo e(__('View PDF Document')); ?>

                                    </a>
                                <?php else: ?>
                                    <div class="document-preview">
                                        <img src="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->front_document)); ?>" alt="front-document">
                                    </div>
                                <?php endif; ?>
                            </a>
                            <a class="radius-5" href="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->back_document)); ?>" target="_blank">
                                <?php if( pathinfo($user_identity_details->back_document, PATHINFO_EXTENSION) === 'pdf'): ?>
                                    <a class="btn btn-info radius-5" href="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->back_document)); ?>" target="_blank">
                                        <?php echo e(__('View PDF Document')); ?>

                                    </a>
                                <?php else: ?>
                                    <div class="document-preview">
                                        <img src="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->back_document)); ?>" alt="back-document">
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                               <?php
                                   if (!empty($user_identity_details->verify_by)) {
                                      $verify_by_name = \App\Models\Backend\Admin::find($user_identity_details->verify_by);
                                  }else{
                                       $verify_by_name = '';
                                  }
                               ?>
                        <p class="userDetails__wrapper__item"><strong><?php echo e(__('Verify by:')); ?></strong> <?php echo e($verify_by_name->name ?? ''); ?></p>
                        <p class="userDetails__wrapper__item"><strong><?php echo e(__('Zip Code:')); ?></strong> <?php echo e($user_identity_details->zip_code ?? ''); ?></p>
                        <p class="userDetails__wrapper__item"><strong><?php echo e(__('Address:')); ?></strong> <?php echo e($user_identity_details->address ?? ''); ?></p>
                          <?php
                              $request_country = \Modules\CountryManage\app\Models\Country::where('id', $user_identity_details->country_id)->first();
                              $request_state = \Modules\CountryManage\app\Models\State::where('id', $user_identity_details->state_id)->first();
                              $request_city = \Modules\CountryManage\app\Models\City::where('id', $user_identity_details->city_id)->first();
                          ?>
                        <p class="userDetails__wrapper__item"><strong><?php echo e(__('Country:')); ?></strong> <?php echo e($request_country->country); ?> </p>
                        <p class="userDetails__wrapper__item"><strong><?php echo e(__('State:')); ?></strong> <?php echo e($request_state->state); ?></p>
                        <p class="userDetails__wrapper__item"><strong><?php echo e(__('City:')); ?></strong> <?php echo e($request_city->city); ?> </p>
                    <?php else: ?>
                        <div class="userProfileDetails__noInfo">
                            <h6 class="userProfileDetails__noInfo__title"><?php echo e(__('No Information')); ?></h6>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/tutreqhl/public_html/core/resources/views/backend/pages/user/profile-and-identity-compare.blade.php ENDPATH**/ ?>