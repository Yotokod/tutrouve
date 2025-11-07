<!-- Team Area Start -->
<div class="about-us">
    <section class="teamArea section-padding plr">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-9 col-sm-10">
                    <div class="section-tittle section-tittle6 text-center mb-50">
                        <h2 class="tittle p-0"> <?php echo e($title); ?> </h2>
                        <span> <?php echo e($subtitle); ?> </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $repeater_data['name_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="singleTeam mb-24">
                            <div class="teamImg">
                                <?php echo render_image_markup_by_attachment_id($repeater_data['image_'][$key]); ?>

                                <!-- Social -->
                                <ul class="teamSocial">
                                    <?php if(!empty($repeater_data['social_icon_one_'][$key])): ?>
                                        <li class="list">
                                            <a href="<?php echo e($repeater_data['social_icon_link_one_'][$key]); ?>" target="_blank" class="singleSocial"><i class="<?php echo e($repeater_data['social_icon_one_'][$key]); ?> icon"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty($repeater_data['social_icon_two_'][$key])): ?>
                                        <li class="list">
                                            <a href="<?php echo e($repeater_data['social_icon_link_two_'][$key]); ?>" target="_blank" class="singleSocial"><i class="<?php echo e($repeater_data['social_icon_two_'][$key]); ?> icon"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty($repeater_data['social_icon_three_'][$key])): ?>
                                        <li class="list">
                                            <a href="<?php echo e($repeater_data['social_icon_link_three_'][$key]); ?>" target="_blank" class="singleSocial"><i class="<?php echo e($repeater_data['social_icon_three_'][$key]); ?> icon"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty($repeater_data['social_icon_four_'][$key])): ?>
                                        <li class="list">
                                            <a href="<?php echo e($repeater_data['social_icon_link_four_'][$key]); ?>" target="_blank" class="singleSocial"><i class="<?php echo e($repeater_data['social_icon_four_'][$key]); ?> icon"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="teamCaption">
                                <h3><a href="#" class="title"><?php echo e($team); ?></a></h3>
                                <p class="pera"><?php echo e($repeater_data['designation_'][$key]); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
</div>
    <!-- End-of Team -->
<?php /**PATH /home/tutreqhl/public_html/core/app/Providers/../../plugins/PageBuilder/views/team/team-one.blade.php ENDPATH**/ ?>