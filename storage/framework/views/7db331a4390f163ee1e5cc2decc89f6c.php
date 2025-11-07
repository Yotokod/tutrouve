<div class="seller-phone text-center">
    <p><?php echo e(__('Phone')); ?></p>
    <span type="text" id="default_phone_number_show" class="number"><?php echo e(__('+XX XXX XXX XX')); ?></span>
    <?php if($listing->phone_hidden == 0): ?>
         <div class="number" id="phoneNumber"><?php echo e($listing->phone); ?></div>
        <a href="#" class="show-number" id="userPhoneNumberBtn"><?php echo e(get_static_option('listing_show_phone_number_title') ?? __('Afficher')); ?></a>
    <?php endif; ?>
</div>
<?php /**PATH /home/tutreqhl/public_html/core/resources/views/components/listings/user-listing-phone.blade.php ENDPATH**/ ?>