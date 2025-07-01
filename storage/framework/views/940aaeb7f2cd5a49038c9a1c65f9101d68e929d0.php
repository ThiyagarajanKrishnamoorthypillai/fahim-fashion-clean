

<?php
$baseURL = getBaseURL();
?>

<?php $__env->startSection('content'); ?>
    <main class="main_wrapper">
        <div class="container content form_box d-flex justify-content-center align-items-center">
            <div class="inner-wrapper change_pass_form">
                <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <h3 class="title">Login</h3>
                <form class="default_form row m-0" method="post" action="<?php echo e(route('admin.doLogin')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group col-sm-12">
                        <label for="s">Phone Number, Email Address Or Username <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="s"
                               placeholder="Phone Number, Email Address Or Username"
                               name="username_email_phone" value="<?php echo e(old('username_email_phone')); ?>">
                        <?php if($errors->has('username_email_phone')): ?>
                            <div class="invalid_feedback"><?php echo e($errors->first('username_email_phone')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="newPassword">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="newPassword" placeholder="Password"
                               name="password" value="<?php echo e(old('password')); ?>">
                        <?php if($errors->has('password')): ?>
                            <div class="invalid_feedback"><?php echo e($errors->first('password')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-between align-items-center p-0">
                        <button type="submit" class="c-btn btn-fill submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo $baseURL.'assets/js/aos.js'; ?>"></script>
    <script src="<?php echo $baseURL.'assets/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo $baseURL.'assets/css/datepicker/bootstrap-datepicker.js'; ?>"></script>
    <script src="<?php echo $baseURL.'assets/js/select2.min.js'; ?>"></script>
    <script src="<?php echo $baseURL.'assets/js/summernote.min.js'; ?>"></script>
    <script src="<?php echo $baseURL.'assets/js/main.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\admin\login.blade.php ENDPATH**/ ?>