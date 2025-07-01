

<?php $__env->startSection('script_top'); ?>
    <?php
    $setting = getSettingsInfo();
    $tax_setting = getTaxInfo();
    $baseURL = getBaseURL();
    ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="main-content-wrapper">
        <section class="content-header">
            <h3 class="top-left-header">
                <?php echo e(isset($title) && $title ? $title : ''); ?>

            </h3>
        </section>

        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                <?php echo Form::model(isset($obj) && $obj ? $obj : '', [
                    'id' => 'product_form',
                    'method' => isset($obj) && $obj ? 'PATCH' : 'POST',
                    'enctype' => 'multipart/form-data',
                    'route' => ['finishedproducts.update', isset($obj->id) && $obj->id ? $obj->id : ''],
                ]); ?>

                <?php echo csrf_field(); ?>
                <div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.name'); ?> <span class="required_star">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="check_required form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Name" value="<?php echo e(isset($obj) && $obj ? $obj->name : old('name')); ?>">
                                <div class="text-danger d-none"></div>
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

                        <div class="col-sm-12 col-md-6 mb-2 col-lg-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.code'); ?> <span class="required_star">*</span></label>
                                <input type="text" name="code" id="code"
                                    class="check_required form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Code" value="<?php echo e(isset($obj->code) ? $obj->code : $ref_no); ?>"
                                    onfocus="select()">
                                <div class="text-danger d-none"></div>
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
                                    id="category_id">
                                    <option value=""><?php echo app('translator')->get('index.select_category'); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php echo e(isset($obj->category) && $obj->category == $value->id || old('category') == $value->id ? 'selected' : ''); ?>

                                            value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="text-danger d-none"></div>
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

                        <div class="clearfix"></div>
                        <div class="col-sm-12 col-md-6 mb-2 col-lg-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.unit'); ?> <span class="required_star">*</span></label>
                                <select class="form-control <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2" name="unit"
                                    id="unit_id">
                                    <option value=""><?php echo app('translator')->get('index.select_unit'); ?></option>
                                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php echo e(isset($obj->unit) && $obj->unit == $value->id || old('unit') == $value->id ? 'selected' : ''); ?>

                                            value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="text-danger d-none"></div>
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
                        <div class="col-sm-12 col-md-6 mb-2 col-lg-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.stock_method'); ?> <span class="required_star">*</span></label>
                                <select class="form-control <?php $__errorArgs = ['stock_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2"
                                    name="stock_method" id="stocks">
                                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->stock_method) && $obj->stock_method == 'none' || old('stock_method') == 'none' ? 'selected' : ''); ?>

                                        value="none"><?php echo app('translator')->get('index.none'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->stock_method) && $obj->stock_method == 'fifo' || old('stock_method') == 'fifo' ? 'selected' : ''); ?>

                                        value="fifo"><?php echo app('translator')->get('index.fifo'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->stock_method) && $obj->stock_method == 'batchcontrol' || old('stock_method') == 'batchcontrol' ? 'selected' : ''); ?>

                                        value="batchcontrol"><?php echo app('translator')->get('index.batch_control'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->stock_method) && $obj->stock_method == 'fefo' || old('stock_method') == 'fefo' ? 'selected' : ''); ?>

                                        value="fefo"><?php echo app('translator')->get('index.fefo'); ?></option>
                                </select>
                                <div class="text-danger d-none"></div>
                                <?php $__errorArgs = ['stock_method'];
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

                        <div class="clearfix"></div>
                        <hr>
                        <h4 class=""><?php echo app('translator')->get('index.raw_material_consumption_cost'); ?> (BoM)</h4>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.raw_material'); ?><span class="required_star">*</span></label>
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
                                $totalStock = $rm->current_stock;
                                if ($totalStock > 0) :
                                    $last_p_price = getLastThreePurchasePrice($rm->id);
                                    $last_cp_price = getLastThreeCPurchasePrice($rm->id);
                                ?>
                                        <?php if($rm->consumption_check == 0): ?>
                                            <option value="<?php echo e($rm->id . '|' . $rm->name . ' (' . $rm->code . ')|' . $rm->name . '|' . $rm->cost_in_consumption_unit . '|' . getPurchaseSaleUnitById($rm->unit) . '|' . $setting->currency . '|' . $last_p_price); ?>"><?php echo e($rm->name . '(' . $rm->code . ')'); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($rm->id . '|' . $rm->name . ' (' . $rm->code . ')|' . $rm->name . '|' . $rm->cost_in_consumption_unit . '|' . getPurchaseSaleUnitById($rm->consumption_unit) . '|' . $setting->currency . '|' . $rm->rate_per_consumption_unit); ?>"><?php echo e($rm->name . '(' . $rm->code . ')'); ?>

                                            </option>
                                        <?php endif; ?>

                                        <?php
                                endif;
                                ?>
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
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive rawmaterialsec" id="purchase_cart">
                                <table class="table">
                                    <thead>
                                        <th class="w-10 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-20"><?php echo app('translator')->get('index.raw_material'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                        <th class="w-20"> <?php echo app('translator')->get('index.unit_price'); ?><span class="required_star">*</span>
                                            <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('index.purchase_unit_and_consumption_unit'); ?>"
                                        class="fa fa-question-circle base_color c_pointer"></i>
                                        </th>
                                        <th class="w-20"> <?php echo app('translator')->get('index.consumption'); ?><span class="required_star">*</span></th>
                                        <th class="w-20"><?php echo app('translator')->get('index.total_cost'); ?> </th>
                                        <th class="w-10 text-end"><?php echo app('translator')->get('index.actions'); ?></th>
                                    </thead>
                                    <tbody class="add_tr">
                                        <?php if(isset($fp_rmaterials) && $fp_rmaterials): ?>
                                            <?php $__currentLoopData = $fp_rmaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="rowCount" data-id="<?php echo e($value->rmaterials_id); ?>">
                                                    <td class="width_1_p">
                                                        <p class="set_sn"></p>
                                                    </td>
                                                    <td><input type="hidden" value="<?php echo e($value->rmaterials_id); ?>"
                                                            name="rm_id[]">
                                                        <span><?php echo e(getRMName($value->rmaterials_id)); ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" tabindex="5" name="unit_price[]"
                                                                onfocus="this.select();"
                                                                class="check_required form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk input_aligning unit_price_c cal_row"
                                                                placeholder="Unit Price" value="<?php echo e($value->unit_price); ?>"
                                                                id="unit_price_1">
                                                            <span class="input-group-text"
                                                                id="basic-addon2"><?php echo e($setting->currency); ?></span>
                                                        </div>
                                                        <div class="text-danger d-none unitPriceErr"></div>
                                                    </td>

                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" data-countid="1" tabindex="51"
                                                                id="qty_1" name="quantity_amount[]"
                                                                onfocus="this.select();"
                                                                class="check_required form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk input_aligning qty_c cal_row"
                                                                value="<?php echo e($value->consumption); ?>"
                                                                placeholder="Consumption">
                                                            <span class="input-group-text"
                                                                id="basic-addon2"><?php echo e(getManufactureUnitByRMID($value->rmaterials_id)); ?></span>
                                                        </div>
                                                        <div class="text-danger d-none qtyErr"></div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <input type="number" id="total_1" name="total[]"
                                                                class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> input_aligning total_c"
                                                                value="<?php echo e($value->consumption_unit); ?>"
                                                                placeholder="Total" readonly="">
                                                            <span class="input-group-text"
                                                                id="basic-addon2"><?php echo e($setting->currency); ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end"><a
                                                            class="btn btn-xs del_row dlt_button"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-broken"></iconify-icon></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="w-10"></td>
                                        <td class="w-20"></td>
                                        <td class="w-20"></td>
                                        <td class="w-20"></td>
                                        <td class="w-20">
                                            <label><?php echo app('translator')->get('index.total_raw_material_cost'); ?> <span class="required_star">*</span></label>
                                            <div class="input-group">
                                                <input type="text" name="rmcost_total" id="rmcost_total"
                                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" readonly
                                                    placeholder="<?php echo e(__('index.total_raw_material_cost')); ?>">
                                                <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                                            </div>
                                        </td>
                                        <td class="w-10 text-end"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="clearfix"></div>
                        <h4 class=""><?php echo app('translator')->get('index.non_inventory_cost'); ?></h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('index.non_inventory_item'); ?></label>
                                    <select tabindex="4"
                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2 select2-hidden-accessible"
                                        name="noniitem" id="noniitem">
                                        <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                        <?php $__currentLoopData = $nonitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($rm->id . '|' . $rm->name . '|' . $setting->currency); ?>"><?php echo e($rm->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="purchase_cart">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="w-10 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                            <th class="w-60"><?php echo app('translator')->get('index.non_inventory_item'); ?></th>
                                            <th class="w-20"> <?php echo app('translator')->get('index.non_inventory_cost'); ?> </th>
                                            <th class="w-10 text-end"><?php echo app('translator')->get('index.actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_tr1">

                                        <?php if(isset($fp_nonitems) && $fp_nonitems): ?>
                                            <?php $__currentLoopData = $fp_nonitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="rowCount1" data-id="<?php echo e($value->noninvemtory_id); ?>">
                                                    <td class="width_1_p">
                                                        <p class="set_sn1"></p>
                                                    </td>
                                                    <td><input type="hidden" value="<?php echo e($value->noninvemtory_id); ?>"
                                                            name="noniitem_id[]">
                                                        <span><?php echo e(getNonInventroyItem($value->noninvemtory_id)); ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" id="total_1" name="total_1[]"
                                                                class="cal_row  form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> aligning total_c1"
                                                                onfocus="select();" value="<?php echo e($value->nin_cost); ?>"
                                                                placeholder="Total">
                                                            <span class="input-group-text"
                                                                id="basic-addon2"><?php echo e($setting->currency); ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end"><a
                                                            class="btn btn-xs del_row dlt_button"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-broken"></iconify-icon>
                                                        </a></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="w-10"></td>
                                        <td class="w-60"></td>
                                        <td class="w-20">
                                            <label><?php echo app('translator')->get('index.total_non_inventory_cost'); ?></label>
                                            <div class="input-group">
                                                <input type="text" name="noninitem_total" id="noninitem_total"
                                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" readonly
                                                    placeholder="<?php echo e(__('index.total_non_inventory_cost')); ?>">
                                                <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                                            </div>
                                        </td>
                                        <td class="w-10 text-end"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('index.total_cost'); ?> <span class="required_star">*</span></label>
                            <div class="input-group">
                                <input type="text" name="total_cost" id="total_cost"
                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> total_cos margin_cal"
                                    readonly placeholder="Total Non Inventory Cost">
                                <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('index.profit_margin'); ?> (%)</label>
                            <div class="input-group">
                                <input type="text" name="profit_margin" id="profit_margin"
                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> profit_margin margin_cal"
                                    placeholder="Profit Margin" value="<?php echo e(isset($obj) && $obj ? $obj->profit_margin : old('profit_margin')); ?>">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <?php
                        $collect_tax = $tax_items->collect_tax;
                        $tax_type = $tax_items->tax_type;
                        $tax_information = json_decode(isset($obj->tax_information) && $obj->tax_information ? $obj->tax_information : '');
                        ?>
                        <input type="hidden" name="tax_type" class="tax_type" value="<?php echo e($tax_type); ?>">
                        <?php $__currentLoopData = $tax_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 <?php echo e(isset($collect_tax) && $collect_tax == 'Yes' ? '' : 'd-none'); ?>">
                                <?php if($tax_information): ?>
                                    <?php $__currentLoopData = $tax_information; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($tax_field->id == $single_tax->tax_field_id): ?>
                                            <label><?php echo e($tax_field->tax); ?></label>
                                            <input onfocus="select();" tabindex="1" type="hidden"
                                                name="tax_field_id[]" value="<?php echo e($single_tax->tax_field_id); ?>">
                                            <input onfocus="select();" tabindex="1" type="hidden"
                                                name="tax_field_name[]" value="<?php echo e($single_tax->tax_field_name); ?>">
                                            <div class="input-group">
                                                <input onfocus="select();" tabindex="1" type="text"
                                                    name="tax_field_percentage[]"
                                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk get_percentage cal_row"
                                                    placeholder="" value="<?php echo e($single_tax->tax_field_percentage); ?>">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <label><?php echo e($tax_field->tax); ?></label>
                                    <input onfocus="select();" tabindex="1" type="hidden" name="tax_field_id[]"
                                        value="<?php echo e($tax_field->id); ?>">
                                    <input onfocus="select();" tabindex="1" type="hidden" name="tax_field_name[]"
                                        value="<?php echo e($tax_field->tax); ?>">
                                    <div class="input-group">
                                        <input onfocus="select();" tabindex="1" type="text"
                                            name="tax_field_percentage[]"
                                            class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk get_percentage cal_row"
                                            placeholder="<?php echo e($tax_field->tax); ?>" value="<?php echo e($tax_field->tax_rate); ?>">
                                        <span class="input-group-text">%</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('index.sale_price'); ?> <span class="required_star">*</span></label>
                            <div class="input-group">
                                <input type="text" name="sale_price" id="sale_price"
                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> margin_cal sale_price"
                                    readonly placeholder="Sale Price" value="<?php echo e(isset($obj) && $obj ? $obj->sale_price : old('sale_price')); ?>">
                                <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                    <h4 class=""><?php echo app('translator')->get('index.manufacture_stages'); ?></h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.manufacture_stages'); ?></label>
                                <select tabindex="4"
                                    class="form-control <?php $__errorArgs = ['productionstage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2 select2-hidden-accessible"
                                    name="productionstage" id="productionstage">
                                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                    <?php $__currentLoopData = $productionstage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ps->id . '|' . $ps->name); ?>"><?php echo e($ps->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <?php $__errorArgs = ['productionstage'];
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
                        <div class="col-md-12">
                            <div class="table-responsive" id="purchase_cart">
                                <table class="table" id="drageable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="width_1_p text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                            <th class="width_20_p stage_header text-left">
                                                <?php echo app('translator')->get('index.stage'); ?></th>
                                            <th class="width_20_p stage_header"><?php echo app('translator')->get('index.required_time'); ?></th>
                                            <th class="width_1_p ir_txt_center"><?php echo app('translator')->get('index.actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_tr2 sort_menu">

                                        <?php if(isset($fp_productionstages) && $fp_productionstages): ?>
                                            <?php
                                                $total_month = 0;
                                                $total_hour = 0;
                                                $total_day = 0;
                                                $total_mimute = 0;
                                            ?>
                                            <?php $__currentLoopData = $fp_productionstages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php                                               

                                                $total_value = $value->stage_month * 2592000 + $value->stage_day * 86400 + $value->stage_hours * 3600 + $value->stage_minute * 60;
                                                $months = floor($total_value / 2592000);
                                                $hours = floor(($total_value % 86400) / 3600);
                                                $days = floor(($total_value % 2592000) / 86400);
                                                $minuts = floor(($total_value % 3600) / 60);
                                                
                                                $total_month += $months;
                                                $total_hour += $hours;
                                                $total_day += $days;
                                                $total_mimute += $minuts;
                                                
                                                $total_stages = $total_month * 2592000 + $total_hour * 3600 + $total_day * 86400 + $total_mimute * 60;
                                                $total_months = floor($total_stages / 2592000);
                                                $total_hours = floor(($total_stages % 86400) / 3600);
                                                $total_days = floor(($total_stages % 2592000) / 86400);
                                                $total_minutes = floor(($total_stages % 3600) / 60);
                                                
                                                ?>
                                                <tr class="rowCount2 align-middle ui-state-default" data-id="<?php echo e($value->productionstage_id); ?>">
                                                <td><span class="handle me-2"><iconify-icon icon="radix-icons:move"></iconify-icon></span></td>
                                                    <td class="width_1_p">
                                                        <p class="set_sn2 m-0"></p>
                                                    </td>
                                                    <td class="stage_name text-left"><input type="hidden"
                                                            value="<?php echo e($value->productionstage_id); ?>"
                                                            name="producstage_id[]">
                                                        <span><?php echo e(getProductionStages($value->productionstage_id)); ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="input-group"><input
                                                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning"
                                                                        type="text" id="month_limit"
                                                                        name="stage_month[]" min="0"
                                                                        max="02" value="<?php echo e($value->stage_month); ?>"
                                                                        placeholder="Month"><span
                                                                        class="input-group-text"><?php echo app('translator')->get('index.months'); ?></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-group"><input
                                                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning"
                                                                        type="text" id="day_limit" name="stage_day[]"
                                                                        min="0" max="31"
                                                                        value="<?php echo e($value->stage_day); ?>"
                                                                        placeholder="Days"><span
                                                                        class="input-group-text"><?php echo app('translator')->get('index.days'); ?></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-group"><input
                                                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning"
                                                                        type="text" id="hours_limit"
                                                                        name="stage_hours[]" min="0"
                                                                        max="24" value="<?php echo e($value->stage_hours); ?>"
                                                                        placeholder="Hours"><span
                                                                        class="input-group-text"><?php echo app('translator')->get('index.hours'); ?></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="input-group"><input
                                                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning"
                                                                        type="text" id="minute_limit"
                                                                        name="stage_minute[]" min="0"
                                                                        max="60" value="<?php echo e($value->stage_minute); ?>"
                                                                        placeholder="Minutes"><span
                                                                        class="input-group-text"><?php echo app('translator')->get('index.minutes'); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="ir_txt_center"><a
                                                            class="btn btn-xs del_row dlt_button"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-broken"></iconify-icon></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tr class="align-middle">
                                        <td></td>
                                        <td class="width_1_p"></td>
                                        <td class="width_1_p"><?php echo app('translator')->get('index.total'); ?></td>
                                        <td class="width_20_p stage_header">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <input
                                                            class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning stage_color"
                                                            readonly type="text" id="t_month"
                                                            value="<?php echo e(isset($total_months) && $total_months ? $total_months : ''); ?>"
                                                            placeholder="Months">
                                                        <span class="input-group-text"><?php echo app('translator')->get('index.months'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <input
                                                            class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning stage_color"
                                                            readonly type="text" id="t_day"
                                                            value="<?php echo e(isset($total_days) && $total_days ? $total_days : ''); ?>"
                                                            placeholder="Days">
                                                        <span class="input-group-text"><?php echo app('translator')->get('index.days'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <input
                                                            class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning stage_color"
                                                            readonly type="text" id="t_hours"
                                                            value="<?php echo e(isset($total_hours) && $total_hours ? $total_hours : ''); ?>"
                                                            placeholder="Hours">
                                                        <span class="input-group-text"><?php echo app('translator')->get('index.hours'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <input
                                                            class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> stage_aligning stage_color"
                                                            readonly type="text" id="t_minute"
                                                            value="<?php echo e(isset($total_minutes) && $total_minutes ? $total_minutes : ''); ?>"
                                                            placeholder="Minutes">
                                                        <span class="input-group-text"><?php echo app('translator')->get('index.minutes'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="width_1_p ir_txt_center"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="row mt-2">
                    <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                        <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                                icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.submit'); ?></button>
                        <a class="btn bg-second-btn" href="<?php echo e(route('finishedproducts.index')); ?>"><iconify-icon
                                icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo $baseURL . 'assets/bower_components/jquery-ui/jquery-ui.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/addFinishedProduct.js?v=1.2'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\finished_product\duplicateProduct.blade.php ENDPATH**/ ?>