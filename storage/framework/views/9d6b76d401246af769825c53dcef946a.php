$('.icp-dd').iconpicker();
$('.icp-dd').on('iconpickerSelected', function (e) {
var selectedIcon = e.iconpickerValue;
$(this).parent().parent().children('input').val(selectedIcon);
});
<?php /**PATH /home/tutreqhl/public_html/core/resources/views/components/icon/icon-picker.blade.php ENDPATH**/ ?>