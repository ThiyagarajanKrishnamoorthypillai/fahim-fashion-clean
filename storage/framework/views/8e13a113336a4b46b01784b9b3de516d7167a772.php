<?php
$baseURL = getBaseURL();
?>


<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="image">
            <img alt="Broken light bulb illustration" height="150"
                src="<?php echo e($baseURL); ?>/<?php echo e('frequent_changing/images/403.png'); ?>"
                width="150" />
        </div>
        <div class="error-code">
            403
        </div>
        <div class="message">
            <?php echo app('translator')->get('index.forbidden'); ?>
        </div>
        <div class="sub-message">
            <?php echo app('translator')->get('index.forbidden_message'); ?>
        </div>
        <a class="home-link" href="<?php echo e($baseURL); ?>">
            <?php echo app('translator')->get('index.go_to_home'); ?>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\errors\403.blade.php ENDPATH**/ ?>