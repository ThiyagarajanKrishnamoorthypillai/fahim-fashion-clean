

<?php $__env->startSection('content'); ?>
    <section class="main-content-wrapper">
        <section class="content-header">
            <h3 class="top-left-header">
                <?php echo e(isset($title) && $title ? $title : ''); ?>

            </h3>
        </section>


        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                <?php echo Form::model(isset($obj) && $obj ? $obj : '', [
                    'method' => isset($obj) && $obj ? 'PATCH' : 'POST',
                    'route' => ['rawmaterials.update', isset($obj->id) && $obj->id ? $obj->id : ''],
                ]); ?>

                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('index.name'); ?> <span class="required_star">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Name"
                                value="<?php echo e(isset($obj->name) ? $obj->name : old('name')); ?>">
                            <?php $__errorArgs = ['name'];
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
                            <label><?php echo app('translator')->get('index.code'); ?> <span class="required_star">*</span></label>
                            <input type="text" name="code" id="code"
                                class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Code"
                                value="<?php echo e(isset($obj->code) ? $obj->code : $code); ?>" onfocus="select()">
                            <?php $__errorArgs = ['code'];
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
                            <label><?php echo app('translator')->get('index.category'); ?> <span class="required_star">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2" name="category"
                                id="category">
                                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        <?php echo e((isset($obj->category) && $obj->category == $value->id) || old('category') == $value->id ? 'selected' : ''); ?>

                                        value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category'];
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

                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('index.unit'); ?> <span class="required_star">*</span> </label>
                            <select class="form-control <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2 con_unit" name="unit"
                                id="unit">
                                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        <?php echo e((isset($obj->unit) && $obj->unit == $value->id) || old('unit') == $value->id ? 'selected' : ''); ?>

                                        value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['unit'];
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
                        <label class="custom_label"><?php echo app('translator')->get('index.rate_per_unit'); ?> <small>(<?php echo app('translator')->get('index.purchase'); ?>)</small><span
                                class="required_star">*</span></label>
                        <div class="input-group">
                            <input type="text" name="rate_per_unit" id="rate_per_unit"
                                class="form-control <?php $__errorArgs = ['rate_per_unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk consumption"
                                placeholder="Rate Per Unit"
                                value="<?php echo e(isset($obj->rate_per_unit) ? $obj->rate_per_unit : old('rate_per_unit')); ?>">
                            <span class="input-group-text">
                                <?php echo e(getCurrencyOnly()); ?>

                            </span>
                        </div>
                        <?php $__errorArgs = ['rate_per_unit'];
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
                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('index.consumption_unit_is_different'); ?></label>
                            <input type="checkbox" name="consumption_check" id="consumption_check"
                                class="consumption_check field_clear" value="1"
                                <?php echo e(isset($obj->consumption_check) && $obj->consumption_check || old('consumption_check') ? 'checked' : ''); ?>>
                            <?php $__errorArgs = ['consumption_check'];
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
                <div class="row <?php echo e(isset($obj->consumption_check) && $obj->consumption_check == '1' || old('consumption_check') == 1 ? 'd-flex' : 'd-none'); ?>"
                    id="consumption_div">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('index.consumption_unit'); ?> <span class="required_star">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['consumption_unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2"
                                name="consumption_unit" id="consumption_unit">
                                <option class="cuempty" value="">Select</option>
                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        <?php echo e((isset($obj->consumption_unit) && $obj->consumption_unit == $value->id) || old('consumption_unit') == $value->id ? 'selected' : ''); ?>

                                        value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['consumption_unit'];
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <table class="width_100_p">
                                <tr>
                                    <td> <label><?php echo app('translator')->get('index.conversion_rate'); ?> <span class="required_star">*</span></label>
                                        <input type="text" name="conversion_rate" id="conversion_rate"
                                            class="form-control <?php $__errorArgs = ['conversion_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk consumption"
                                            onfocus="select()" min="1" placeholder="Conversion Rate"
                                            value="<?php echo e(isset($obj->conversion_rate) ? $obj->conversion_rate : old('conversion_rate')); ?>">
                                        <?php $__errorArgs = ['conversion_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="custom_label"><?php echo app('translator')->get('index.rate_per_consumption_unit'); ?></label>
                        <div class="input-group">
                            <input type="text" name="rate_per_consumption_unit" id="rate_per_consumption_unit"
                                class="form-control <?php $__errorArgs = ['rate_per_consumption_unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk change_consumption_cost rate_per_consumption_unit"
                                readonly placeholder="Cost in Consumption Unit"
                                value="<?php echo e(isset($obj->rate_per_consumption_unit) ? $obj->rate_per_consumption_unit : old('rate_per_consumption_unit')); ?>">
                            <span class="input-group-text">
                                <?php echo e(getCurrencyOnly()); ?>

                            </span>
                        </div>
                        <?php $__errorArgs = ['rate_per_consumption_unit'];
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

                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-4">
                        <label class="custom_label"><?php echo app('translator')->get('index.opening_stock'); ?></label>
                        <div class="input-group">
                            <input type="text" name="opening_stock" id="opening_stock"
                                class="form-control <?php $__errorArgs = ['opening_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk"
                                min="1" placeholder="Opening Stock"
                                value="<?php echo e(isset($obj->opening_stock) ? $obj->opening_stock : old('opening_stock')); ?>">
                            <span class="input-group-text opening_stock_unit">
                                <?php echo e(isset($obj) ? (isset($obj->consumption_check) && $obj->consumption_check == '1' ? getRMUnitById($obj->consumption_unit) : getRMUnitById($obj->unit)) : 'pcs'); ?>

                            </span>
                        </div>
                        <?php $__errorArgs = ['opening_stock'];
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
                        <label class="custom_label"><?php echo app('translator')->get('index.alter_level'); ?></label>
                        <div class="input-group">
                            <input type="text" name="alert_level" id="alert_level"
                                class="form-control <?php $__errorArgs = ['alert_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk" min="1"
                                placeholder="Alert Level" value="<?php echo e(isset($obj->alert_level) ? $obj->alert_level : old('alert_level')); ?>">
                            <span class="input-group-text opening_stock_unit">
                                <?php echo e(isset($obj) ? (isset($obj->consumption_check) && $obj->consumption_check == '1' ? getRMUnitById($obj->consumption_unit) : getRMUnitById($obj->unit)) : 'pcs'); ?>

                            </span>
                        </div>
                        <?php $__errorArgs = ['alert_level'];
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

                <div class="row mt-2">
                    <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                        <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                                icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.submit'); ?></button>
                        <a class="btn bg-second-btn" href="<?php echo e(route('rawmaterials.index')); ?>"><iconify-icon
                                icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
                    </div>
                </div>
                <!-- /.box-body -->
                <?php echo Form::close(); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php
    $baseURL = getBaseURL();
    ?>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/addRawMaterial.js'; ?>"></script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\rawmaterial\addEditRawMaterial.blade.php ENDPATH**/ ?>