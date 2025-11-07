<div style="border:none">

        <?php if($listings->count() >0): ?>
            <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('frontend.listing.details',$listing->slug)); ?>" class="suggestion-items" style="display: flex; align-items: center; gap: 10px; ">
                    <div class="search_thumb bg-image" <?php echo render_background_image_markup_by_attachment_id($listing->image,'','thumb'); ?>></div>
                    <div class="text-part">
                        <span class="search-text-item oneLine"> <?php echo e($listing->title); ?></span>
                        <span class="home_listing_price"> <?php echo e(float_amount_with_currency_symbol($listing->price)); ?> </span>
                    </div>
                </a><br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="text-center"><p class="text-left text-info"><?php echo e(__("Acun résultat")); ?></p><br>
            <a class="btn btn-secondary" href="<?php echo e('/listings'); ?>">Voir toutes les annonces</a></div>
        <?php endif; ?>
    </div>

<?php /**PATH /home/tutreqhl/public_html/core/resources/views/frontend/layout/partials/search/search-result.blade.php ENDPATH**/ ?>