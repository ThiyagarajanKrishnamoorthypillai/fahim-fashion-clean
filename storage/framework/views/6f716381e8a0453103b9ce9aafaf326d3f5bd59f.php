

<?php $__env->startSection('script_top'); ?>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <h3 class="top-left-header">
                <?php echo e(isset($title) && $title ? $title : ''); ?>

            </h3>
        </section>


        <div class="box-wrapper">
            <div class="table-box">
                <!-- form start -->
                <?php echo Form::model(isset($obj) && $obj ? $obj : '', [
                    'id' => 'purchase_form',
                    'method' => 'POST',
                    'route' => isset($obj) && $obj ? ['stockAdjustUpdate', encrypt_decrypt($obj->id, 'encrypt')] : 'stockAdjustPost',
                ]); ?>

                <?php echo csrf_field(); ?>
                <div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.raw_material'); ?> <span class="required_star">*</span> (<?php echo app('translator')->get('index.only_stock_available_are_listed'); ?>)</label>
                                <select tabindex="4"
                                    class="form-control <?php $__errorArgs = ['rmaterial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2 select2-hidden-accessible"
                                    name="rmaterial" id="rmaterial">
                                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                    <?php $__currentLoopData = $rmaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $totalStock = $rm->total_purchase * $rm->conversion_rate - $rm->total_rm_waste + $rm->opening_stock;
                                            if ($totalStock > 0) {
                                                $last_p_price = getLastThreePurchasePrice($rm->id);
                                            }
                                        ?>
                                        <?php if($totalStock > 0): ?>
                                            <option <?php echo e(isset($obj) && $obj->rm_id == $rm->id ? 'selected' : ''); ?> value="<?php echo e($rm->id . '|' . $rm->name . ' (' . $rm->code . ')|' . $rm->name . '|' . $last_p_price . '|' . $rm->purchase_unit_name . '|' . $setting->currency . '|' . $totalStock); ?>"><?php echo e($rm->name . '(' . $rm->code . ')'); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <?php $__errorArgs = ['rmaterial'];
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
                        <div class="col-sm-12 mb-2 col-md-4">

                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.type'); ?> <span class="required_star">*</span></label>
                                <select name="type" id="type"
                                    class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2">
                                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                    <option value="addition" <?php echo e(isset($obj) && $obj->type == 'addition' ? 'selected' : ''); ?>><?php echo app('translator')->get('index.addition'); ?></option>
                                    <option value="subtraction" <?php echo e(isset($obj) && $obj->type == 'subtraction' ? 'selected' : ''); ?>><?php echo app('translator')->get('index.subtraction'); ?></option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['type'];
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
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.quantity'); ?> <span class="required_star">*</span></label>
                                <input type="text" name="quantity" id="quantity"
                                    class="check_required form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="<?php echo e(__('index.quantity')); ?>" value="<?php echo e(isset($obj) && $obj->quantity ? $obj->quantity : ''); ?>">
                            </div>
                            <?php $__errorArgs = ['quantity'];
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
                <!-- /.box-body -->

                <div class="row mt-2">
                    <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                        <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                                icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.submit'); ?></button>
                        <a class="btn bg-second-btn" href="<?php echo e(route('getRMStock')); ?>"><iconify-icon
                                icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\stock\stockAdjustList.blade.php ENDPATH**/ ?>