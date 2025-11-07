<!--Working and Hiring-->
<div class="about-us" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>" style="background-color: <?php echo e($section_bg); ?>">
  <div class="working-hiring 80">
         <div class="container">
            <?php $__currentLoopData = $repeater_data['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $empowering): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key == 0 || $key == 2 || $key == 4 || $key == 6): ?>
                <div class="working mb-80">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="img">
                                <?php echo render_image_markup_by_attachment_id($repeater_data['image_'][$key]); ?>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="text-part teamArea">
                                <div class="section-tittle">
                                    <h2 class="tittle">
                                        <?php echo e($repeater_data['title_'][$key]); ?>

                                    </h2>
                                </div>
                                <p class="text">
                                    <?php echo e($repeater_data['description_'][$key]); ?>

                                </p>
                                <div class="btn-wraper">
                                    <a href="<?php echo e($repeater_data['button_link_'][$key]); ?>" class="new-cmn-btn rounded-red-btn">  <?php echo e($repeater_data['button_title_'][$key]); ?> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php else: ?>
                     <div class="hiring mb-80">
                         <div class="row align-items-center">
                             <div class="col-md-7">
                                 <div class="text-part teamArea">
                                     <div class="section-tittle">
                                         <h2 class="tittle">
                                             <?php echo e($repeater_data['title_'][$key]); ?>

                                         </h2>
                                     </div>
                                     <p class="text">
                                         <?php echo e($repeater_data['description_'][$key]); ?>

                                     </p>
                                     <div class="btn-wraper mb-md-0 mb-4">
                                         <a href="<?php echo e($repeater_data['button_link_'][$key]); ?>" class="new-cmn-btn rounded-red-btn">  <?php echo e($repeater_data['button_title_'][$key]); ?> </a>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-5">
                                 <div class="img">
                                     <?php echo render_image_markup_by_attachment_id($repeater_data['image_'][$key]); ?>

                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/tutreqhl/public_html/core/app/Providers/../../plugins/PageBuilder/views/empowering/empowering-opportunities-one.blade.php ENDPATH**/ ?>