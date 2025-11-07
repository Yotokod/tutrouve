<!--FAQ part-->
<div class="faq-part" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>" style="background-color: <?php echo e($section_bg); ?>">
    <div class="container-1440">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="list-ocean-faq faqwraper">
                    <h1 class="second-heading mb-4"> <?php echo e($title); ?> </h1>
                    <div class="listocen-faq-wraper" id="listocen-faq-wraper">
                        <?php $__currentLoopData = $repeater_data['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="listocen-faq-item">
                                <h3 class="listocen-faq-title" data-bs-target="#securityOne"><?php echo e($title); ?></h3>
                                <div class="listocen-faq-para" id="securityOne" data-bs-parent="#listocen-faq-wraper" style="display: none;">
                                    <?php echo e($repeater_data['description_'][$key]); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-part">
                        <p><?php echo e($contact_info); ?></p>
                        <div>
                            <a href="<?php echo e($contact_info_link); ?> "><?php echo e($contact_info_title); ?>

                                <span class="right-icon">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/tutreqhl/public_html/core/app/Providers/../../plugins/PageBuilder/views/faq/faq-one.blade.php ENDPATH**/ ?>