<div>
    <div class="row">
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="width_10_p">

                        </th>
                        <th class="width_15_p"><?php echo app('translator')->get('index.name'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.salary'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.additional'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.subtraction'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.total'); ?></th>
                        <th class="width_15_p"><?php echo app('translator')->get('index.note'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row_counter" data-id="<?php echo e(isset($user->user_id) ? $user->user_id : $user->id); ?>">
                            <th class="width_10_p">
                                <label class="container width_83_p"> <?php echo app('translator')->get('index.select'); ?>
                                    <input class="checkbox_user" type="checkbox" <?php if(isset($user->p_status) && $user->p_status): echo 'checked'; endif; ?>
                                        name="product_id<?php echo e(isset($user->user_id) ? $user->user_id : $user->id); ?>">
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <td>
                                <?php echo e($user->name); ?>

                                <input type="hidden" name="user_id[]"
                                    value="<?php echo e(isset($user->user_id) ? $user->user_id : $user->id); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control"
                                    id="salary_<?php echo e(isset($user->user_id) ? $user->user_id : $user->id); ?>" name="salary[]"
                                    value="<?php echo e(isset($user->salary) && $user->salary ? $user->salary : '0.00'); ?>"
                                    readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control cal_row integerchk" onfocus="select()"
                                    id="additional_<?php echo e(isset($user->user_id) ? $user->user_id : $user->id); ?>"
                                    name="additional[]"
                                    value="<?php echo e(isset($user->additional) && $user->additional ? $user->additional : '0.00'); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control cal_row integerchk" onfocus="select()"
                                    id="subtraction_<?php echo e(isset($user->user_id) ? $user->user_id : $user->id); ?>"
                                    name="subtraction[]"
                                    value="<?php echo e(isset($user->subtraction) && $user->subtraction ? $user->subtraction : '0.00'); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" readonly
                                    id="total_<?php echo e(isset($user->user_id) ? $user->user_id : $user->id); ?>" name="total[]"
                                    value="<?php echo e(isset($user->total) && $user->total ? $user->total : '0.00'); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="notes[]"
                                    value="<?php echo e(isset($user->notes) && $user->notes ? $user->notes : ''); ?>">
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="width_10_p">
                            <label class="container width_83_p"> <?php echo app('translator')->get('index.select_all'); ?>
                                <input class="checkbox_userAll" type="checkbox" id="checkbox_userAll">
                                <span class="checkmark"></span>
                            </label>
                        </th>
                        <th class="width_15_p"><?php echo app('translator')->get('index.name'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.salary'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.additional'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.subtraction'); ?></th>
                        <th class="width_10_p"><?php echo app('translator')->get('index.total'); ?> = <span class="total_amount"></span></th>
                        <th class="width_15_p"><?php echo app('translator')->get('index.note'); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <br>
        <div class="col-md-1"></div>
        <div class="clearfix"></div>
        <div class="col-md-8"></div>
    </div>

    <div class="row">
        <div class="col-sm-12 mb-2 col-md-8"></div>
        <div class="col-sm-12 mb-2 col-md-4">
            <div class="form-group">
                <label><?php echo app('translator')->get('index.account'); ?> <span class="required_star">*</span></label>
                <div class="d-flex align-items-center">
                    <div class="w-100">
                        <select tabindex="2" class="form-control select2 <?php $__errorArgs = ['account_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="account_id" name="account_id">
                            <option value=""><?php echo app('translator')->get('index.select_account'); ?></option>
                            <?php $__currentLoopData = $accountList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(isset($obj->account_id) && $obj->account_id == $value->id ? 'selected' : ''); ?>

                                    value="<?php echo e($value->id); ?>">
                                    <?php echo e($value->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['account_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
            <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                    icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.submit'); ?></button>
            <a class="btn bg-second-btn" href="<?php echo e(route('payroll.index')); ?>"><iconify-icon
                    icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
        </div>
    </div>
</div>
<?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\payroll\_form.blade.php ENDPATH**/ ?>