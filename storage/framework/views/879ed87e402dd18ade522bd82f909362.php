<div class="seller-phone text-center">
    <p><?php echo e(__('Phone')); ?></p>
    <span type="text" id="default_phone_number_show_for_responsive" class="number"><?php echo e(__('+XX XXX XXX XX')); ?></span>
    <?php if($listing->phone_hidden == 0): ?>
        <div class="number" id="phoneNumberForResponsive"><?php echo e($listing->phone); ?></div>
        <a href="#" class="show-number callPhoneNumberBtn" id="userPhoneNumberBtnForResponsive"><?php echo e(__('Voir le numéro')); ?>d</a>x
    <?php endif; ?>
</div>
<?php /**PATH /home/tutreqhl/public_html/core/resources/views/components/listings/user-listing-phone-for-responsive.blade.php ENDPATH**/ ?>