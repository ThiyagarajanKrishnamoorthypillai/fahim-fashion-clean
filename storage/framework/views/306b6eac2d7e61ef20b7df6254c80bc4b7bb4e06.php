

<?php $__env->startSection('script_top'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php
$setting = getSettingsInfo();
$tax_setting = getTaxInfo();
$baseURL = getBaseURL();
?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header"><?php echo e(isset($title) && $title?$title:''); ?></h3>
    </section>

    <div class="box-wrapper">
        <!-- general form elements -->
        <div class="table-box">
            <!-- form start -->
            <?php echo e(Form::open(['route'=>'attendance.store', 'id' => "attendance_form", 'method'=>'post'])); ?>

                <?php echo $__env->make('pages/attendance/_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo $baseURL.'assets/plugins/local/jquery.timepicker.min.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo $baseURL.'assets/plugins/local/jquery.timepicker.min.css'; ?>">
<script src="<?php echo $baseURL.'frequent_changing/js/attendance.js'; ?>"></script>
<script>
	$(document).ready(function () {
        // Toggle visibility of .employee_sec based on the "single" checkbox
        $('#single').change(function () {
            if ($(this).is(':checked')) {
                $('.employee_sec').removeClass('d-none'); // Show section
            } else {
                $('.employee_sec').addClass('d-none'); // Hide section
            }
        });
		
		 // When the "single" checkbox is clicked
        $('#single').change(function () {
            if ($(this).is(':checked')) {
                $('#all').prop('checked', false); // Uncheck "all"
            }
        });

        // When the "all" checkbox is clicked
        $('#all').change(function () {
            if ($(this).is(':checked')) {
				$('.employee_sec').addClass('d-none');
                $('#single').prop('checked', false); // Uncheck "single"
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\attendance\create.blade.php ENDPATH**/ ?>