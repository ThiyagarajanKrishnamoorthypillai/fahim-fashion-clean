

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
            <h3 class="top-left-header">
                <?php echo e(isset($title) && $title ? $title : ''); ?>

            </h3>
        </section>

        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                <?php echo Form::model(isset($obj) && $obj ? $obj : '', [
                    'id' => 'manufacture_form',
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                    'route' => ['duplicate_store'],
                ]); ?>

                <?php echo csrf_field(); ?>
                <?php echo Form::hidden('stage_counter', null, ['class' => 'stage_counter', 'id' => 'stage_counter']); ?>

                <?php echo Form::hidden('stage_name', null, ['class' => 'stage_name', 'id' => 'stage_name']); ?>

                <div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.reference_no'); ?> <span class="required_star">*</span></label>
                                <?php echo Form::text('reference_no', $ref_no, [
                                    'class' => 'check_required form-control',
                                    'id' => 'code',
                                    'onfocus' => 'select()',
                                    'placeholder' => 'Reference No',
                                ]); ?>

                                <?php if($errors->has('reference_no')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('reference_no')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.manufacture_type'); ?> <span class="required_star">*</span></label>
                                <select class="form-control select2" name="manufacture_type" id="manufactures"
                                    required="required">
                                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->manufacture_type) && $obj->manufacture_type == 'ime' ? 'selected' : ''); ?>

                                        value="ime"><?php echo app('translator')->get('index.instant_manufacture_entry'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->manufacture_type) && $obj->manufacture_type == 'mbs' ? 'selected' : ''); ?>

                                        value="mbs"><?php echo app('translator')->get('index.manufacture_by_scheduling'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->manufacture_type) && $obj->manufacture_type == 'fco' ? 'selected' : ''); ?>

                                        value="fco"><?php echo app('translator')->get('index.from_customer_order'); ?></option>
                                </select>

                                <?php if($errors->has('manufacture_type')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('manufacture_type')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.status'); ?> <span class="required_star">*</span></label>
                                <select class="form-control select2" name="manufacture_status" id="m_status"
                                    required="required">
                                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->manufacture_status) && $obj->manufacture_status == 'draft' ? 'selected' : ''); ?>

                                        value="draft"><?php echo app('translator')->get('index.draft'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->manufacture_status) && $obj->manufacture_status == 'inProgress' ? 'selected' : ''); ?>

                                        value="inProgress"><?php echo app('translator')->get('index.in_progress'); ?></option>
                                    <option
                                        <?php echo e(isset($obj->manufacture_status) && $obj->manufacture_status == 'done' ? 'selected' : ''); ?>

                                        value="done"><?php echo app('translator')->get('index.done'); ?></option>
                                </select>
                                <?php if($errors->has('manufacture_status')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('manufacture_status')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-12 col-md-6 mb-2 col-lg-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.start_date'); ?> <span class="required_star">*</span></label>
                                <?php echo Form::text(
                                    'start_date',
                                    isset($obj->start_date) && $obj->start_date ? $obj->start_date : date('Y-m-d', strtotime('today')),
                                    ['class' => 'form-control customDatepicker', 'readonly' => '', 'placeholder' => 'Start Date'],
                                ); ?>

                                <?php if($errors->has('start_date')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('start_date')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2 col-lg-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.complete_date'); ?> </label>
                                <?php echo Form::text(
                                    'complete_date',
                                    isset($obj->complete_date) && $obj->complete_date ? $obj->complete_date : date('Y-m-d', strtotime('today')),
                                    ['class' => 'form-control customDatepicker', 'readonly' => '', 'placeholder' => 'Complete Date'],
                                ); ?>

                                <?php if($errors->has('complete_date')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('complete_date')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div id="customer_order_area" class="row"></div>

                        <div class="clearfix"></div>
                        <?php $st_method = ''; ?>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.product'); ?> <span class="required_star">*</span></label>
                                <select class="form-control select2 fproduct_id" name="product_id" id="fproduct_id"
                                    required="required">
                                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                    <?php if(isset($manufactures) && $manufactures): ?>
                                        <?php $__currentLoopData = $manufactures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                <?php echo e(isset($obj->product_id) && $obj->product_id == $value->id ? 'selected' : ''); ?>

                                                value="<?php echo e($value->id . '|' . $value->stock_method); ?>"><?php echo e($value->name); ?></option>
                                            <?php
                                                if (isset($obj->product_id) && $obj->product_id == $value->id) {
                                                    $st_method = $value->stock_method;
                                                }
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php if($errors->has('product_id')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('product_id')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="col-sm-12 mb-2 col-md-2">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.quantity'); ?> <span class="required_star">*</span></label>
                                <?php echo Form::number('product_quantity', null, [
                                    'class' => 'check_required form-control product_quantity',
                                    'id' => 'product_quantity',
                                    'placeholder' => 'Quantity',
                                ]); ?>

                                <?php if($errors->has('product_quantity')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('product_quantity')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-2 none_method fefo_method <?php if(in_array($st_method, ['none', 'fifo', 'fefo'])): ?> d-none <?php endif; ?>">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.batch_no'); ?> <span class="required_star">*</span></label>
                                <?php echo Form::text('batch_no', null, ['class' => 'form-control', 'id' => 'batch_no', 'placeholder' => 'Batch No']); ?>

                                <?php if($errors->has('batch_no')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('batch_no')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-2 none_method batch_method <?php if(in_array($st_method, ['none', 'batchcontrol'])): ?> d-none <?php endif; ?>">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.expiry_days'); ?> <span class="required_star">*</span></label>
                                <?php echo Form::text('expiry_days', null, [
                                    'class' => 'form-control',
                                    'id' => 'expiry_days',
                                    'placeholder' => 'Expiry Days',
                                ]); ?>

                                <?php if($errors->has('expiry_days')): ?>
                                    <div class="denger_alert">
                                        <?php echo e($errors->first('expiry_days')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-2">
                            <div class="form-group">
                                <button id="pr_go"
                                    class="btn bg-blue-btn w-100 goBtn govalid"><?php echo app('translator')->get('index.go'); ?></button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <h4 class="header_right"><?php echo app('translator')->get('index.raw_material_consumption_cost'); ?> (BoM)</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="fprm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="width_1_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                            <th class="width_10_p"><?php echo app('translator')->get('index.raw_materials'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                            <th class="width_20_p"> <?php echo app('translator')->get('index.rate_per_unit'); ?> <i data-toggle="tooltip"
                                                    data-placement="bottom"
                                                    title="Calculated based on Average of Rate Per Unit of Last 3 or 2 Purchase Price or Rate Per Unit in Material profile"
                                                    class="fa fa-question fa-lg base_color c_pointer tooltip_loss"
                                                    data-original-title="Calculated based on Average of Rate Per Unit of Last 3 or 2 Purchase Price or Rate Per Unit in Material profile"></i>
                                            </th>
                                            <th class="width_20_p"> <?php echo app('translator')->get('index.consumption'); ?></th>
                                            <th class="width_20_p"><?php echo app('translator')->get('index.total_cost'); ?></th>
                                            <th class="width_3_p ir_txt_center"><?php echo app('translator')->get('index.actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_trm">
                                        <?php if(isset($m_rmaterials) && $m_rmaterials): ?>
                                            <?php $__currentLoopData = $m_rmaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="rowCount" data-id="<?php echo e($value->rmaterials_id); ?>">
                                                    <td class="width_1_p ir_txt_center">
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
                                                                class="check_required form-control integerchk unit_price_c cal_row"
                                                                placeholder="Unit Price" value="<?php echo e($value->unit_price); ?>"
                                                                id="unit_price_1">
                                                            <span class="input-group-text">
                                                                <?php echo e($setting->currency); ?></span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" data-countid="1" tabindex="51"
                                                                id="qty_1" name="quantity_amount[]"
                                                                onfocus="this.select();"
                                                                class="check_required form-control integerchk  qty_c cal_row"
                                                                value="<?php echo e($value->consumption); ?>"
                                                                placeholder="Consumption">
                                                            <span
                                                                class="input-group-text"><?php echo e(getManufactureUnitByRMID($value->rmaterials_id)); ?></span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" id="total_1" name="total[]"
                                                                class="form-control total_c"
                                                                value="<?php echo e($value->consumption_unit); ?>"
                                                                placeholder="Total" readonly="">
                                                            <span class="input-group-text">
                                                                <?php echo e($setting->currency); ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="ir_txt_center"><a class="btn btn-xs del_row"><i
                                                                class="color_red fa fa-trash"></i> </a></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <button id="fprmaterial" class="btn bg-blue-btn w-10"
                                    type="button"><?php echo app('translator')->get('index.add_more'); ?></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="clearfix"></div>
                        <div class="col-md-8"></div>
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('index.total_raw_material_cost'); ?></label>
                            <div class="input-group">
                                <?php echo Form::text('mrmcost_total', null, [
                                    'class' => 'form-control',
                                    'readonly' => '',
                                    'id' => 'rmcost_total',
                                    'placeholder' => __('index.total_raw_material_cost'),
                                ]); ?>

                                <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="clearfix"></div>
                        <h4 class=""><?php echo app('translator')->get('index.non_inventory_cost'); ?></h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" id="purchase_cart">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="width_1_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                                <th class="width_20_p"><?php echo app('translator')->get('index.non_inventory_items'); ?></th>
                                                <th class="width_20_p"> <?php echo app('translator')->get('index.non_inventory_item_cost'); ?> </th>
                                                <th class="width_20_p"> <?php echo app('translator')->get('index.account'); ?> </th>
                                                <th class="width_3_p ir_txt_center"><?php echo app('translator')->get('index.actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_tnoni">
                                            <?php if(isset($m_nonitems) && $m_nonitems): ?>
                                                <?php $__currentLoopData = $m_nonitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="rowCount1" data-id="<?php echo e($value->noninvemtory_id); ?>">
                                                        <td class="width_1_p ir_txt_center">
                                                            <p class="set_sn1"></p>
                                                        </td>
                                                        <td><input type="hidden" value="<?php echo e($value->noninvemtory_id); ?>"
                                                                name="noniitem_id[]">
                                                            <span><?php echo e(getNonInventroyItem($value->noninvemtory_id)); ?></span>
                                                        </td>

                                                        <td>
                                                            <div class="input-group">
                                                                <input type="number" id="total_1" name="total_1[]"
                                                                    class="cal_row  form-control aligning total_c1"
                                                                    onfocus="select();" value="<?php echo e($value->nin_cost); ?>"
                                                                    placeholder="Total">
                                                                <span class="input-group-text">
                                                                    <?php echo e($setting->currency); ?></span>
                                                            </div>
                                                        </td>
                                                        <td width="20%">
                                                            <select class="form-control select2" name="account_id[]"
                                                                id="account_id<?php echo e($value->id); ?>">
                                                                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option
                                                                        <?php if(isset($value->account_id) && $value->account_id == $account->id): echo 'selected'; endif; ?>
                                                                        id="account_id" class="account_id"
                                                                        value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td class="ir_txt_center"><a class="btn btn-xs del_row"><i
                                                                    class="color_red fa fa-trash"></i> </a></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <button id="fpnonitem" class="btn bg-blue-btn w-10"
                                        type="button"><?php echo app('translator')->get('index.add_more'); ?></button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-3">
                                <label><?php echo app('translator')->get('index.total_non_inventory_cost'); ?></label>
                                <div class="input-group">
                                    <?php echo Form::text('mnoninitem_total', null, [
                                        'class' => 'form-control',
                                        'readonly' => '',
                                        'id' => 'noninitem_total',
                                        'placeholder' => __('index.total_non_inventory_cost'),
                                    ]); ?>

                                    <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="clearfix"></div>
                        <h4 class=""><?php echo app('translator')->get('index.manufacture_stages'); ?></h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="" id="purchase_cart">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="width_1_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                                <th class="width_20_p stage_header"><?php echo app('translator')->get('index.check'); ?></th>
                                                <th class="width_20_p stage_header text-left">
                                                    <?php echo app('translator')->get('index.stage'); ?></th>
                                                <th class="width_20_p stage_header"><?php echo app('translator')->get('index.required_time'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_tstage">
                                            <?php if(isset($finishProductStage) && $finishProductStage): ?>
                                                <?php
                                                $total_month = 0;
                                                $total_day = 0;
                                                $total_hour = 0;
                                                $total_mimute = 0;
                                                $i = 1;
                                                ?>
                                                <?php $__currentLoopData = $finishProductStage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                    $checked = '';
                                                    $tmp_key = $key + 1;
                                                    if ($obj->stage_counter == $tmp_key) {
                                                        $checked = 'checked=checked';
                                                    }
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
                                                    <tr class="rowCount2" data-id="<?php echo e($value->productionstage_id); ?>">
                                                        <td class="width_1_p ir_txt_center">
                                                            <p class="set_sn2"></p>
                                                        </td>
                                                        <td class="width_1_p"><input class="form-check-input set_class"
                                                                data-stage_name="<?php echo e(getProductionStages($value->productionstage_id)); ?>"
                                                                type="radio" name="stage_check"
                                                                value="<?php echo e($i); ?>" <?php echo e($checked); ?>></td>
                                                        <td class="stage_name text-left"><input
                                                                type="hidden" value="<?php echo e($value->productionstage_id); ?>"
                                                                name="producstage_id[]">
                                                            <span><?php echo e(getProductionStages($value->productionstage_id)); ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="input-group">
                                                                        <input class="form-control stage_aligning"
                                                                            type="text" id="month_limit"
                                                                            name="stage_month[]" class="form-control"
                                                                            min="0" max="12"
                                                                            value="<?php echo e($value->stage_month); ?>"
                                                                            placeholder="Month"><span
                                                                            class="input-group-text"><?php echo app('translator')->get('index.months'); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-group">
                                                                        <input class="form-control stage_aligning"
                                                                            type="text" id="day_limit"
                                                                            name="stage_day[]" min="0"
                                                                            max="31"
                                                                            value="<?php echo e($value->stage_day); ?>"
                                                                            placeholder="Days"><span
                                                                            class="input-group-text"><?php echo app('translator')->get('index.days'); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-group">
                                                                        <input class="form-control stage_aligning"
                                                                            type="text" id="hours_limit"
                                                                            name="stage_hours[]" min="0"
                                                                            max="24"
                                                                            value="<?php echo e($value->stage_hours); ?>"
                                                                            placeholder="Hours"><span
                                                                            class="input-group-text"><?php echo app('translator')->get('index.hours'); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-group">
                                                                        <input class="form-control stage_aligning"
                                                                            type="text" id="minute_limit"
                                                                            name="stage_minute[]" min="0"
                                                                            max="60"
                                                                            value="<?php echo e($value->stage_minute); ?>"
                                                                            placeholder="Minutes"><span
                                                                            class="input-group-text"><?php echo app('translator')->get('index.minutes'); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                        <tr>
                                            <td class="width_1_p"></td>
                                            <td class="width_1_p"></td>
                                            <td class="width_1_p"><?php echo app('translator')->get('index.total'); ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <input class="form-control stage_aligning stage_color" readonly
                                                                type="text" id="t_month"
                                                                value="<?php echo e(isset($total_months) && $total_months ? $total_months : ''); ?>"
                                                                placeholder="Months">
                                                            <span class="input-group-text"><?php echo app('translator')->get('index.months'); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <input class="form-control stage_aligning stage_color" readonly
                                                                type="text" id="t_day"
                                                                value="<?php echo e(isset($total_days) && $total_days ? $total_days : ''); ?>"
                                                                placeholder="Days">
                                                            <span class="input-group-text"><?php echo app('translator')->get('index.days'); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <input class="form-control stage_aligning stage_color" readonly
                                                                type="text" id="t_hours"
                                                                value="<?php echo e(isset($total_hours) && $total_hours ? $total_hours : ''); ?>"
                                                                placeholder="Hours">
                                                            <span class="input-group-text"><?php echo app('translator')->get('index.hours'); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <input class="form-control stage_aligning stage_color" readonly
                                                                type="text" id="t_minute"
                                                                value="<?php echo e(isset($total_minutes) && $total_minutes ? $total_minutes : ''); ?>"
                                                                placeholder="Minutes">
                                                            <span class="input-group-text"><?php echo app('translator')->get('index.minutes'); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="row">
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('index.total_cost'); ?> <span class="required_star">*</span></label>
                            <div class="input-group">
                                <?php echo Form::text('mtotal_cost', null, [
                                    'class' => 'form-control total_cos margin_cal',
                                    'readonly' => '',
                                    'id' => 'total_cost',
                                    'placeholder' => 'Total Non Inventory Cost',
                                ]); ?>

                                <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('index.profit_margin'); ?> (%)</label>
                            <div class="input-group">
                                <?php echo Form::text('mprofit_margin', null, [
                                    'class' => 'form-control profit_margin margin_cal integerchk',
                                    'id' => 'profit_margin',
                                    'placeholder' => 'Profit Margin',
                                ]); ?>

                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $collect_tax = $tax_items->collect_tax;
                        $tax_information = json_decode(isset($obj->tax_information) && $obj->tax_information ? $obj->tax_information : '');
                        ?>
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
                                                    class="form-control integerchk get_percentage cal_row" placeholder=""
                                                    value="<?php echo e($single_tax->tax_field_percentage); ?>">
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
                                            class="form-control integerchk get_percentage cal_row"
                                            placeholder="<?php echo e($tax_field->tax); ?>" value="<?php echo e($tax_field->tax_rate); ?>">
                                        <span class="input-group-text">%</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label><?php echo app('translator')->get('index.sale_price'); ?> <span class="required_star">*</span></label>
                            <div class="input-group">
                                <?php echo Form::text('msale_price', null, [
                                    'class' => 'form-control margin_cal sale_price',
                                    'readonly' => '',
                                    'id' => 'sale_price',
                                    'placeholder' => 'Sale Price',
                                ]); ?>

                                <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6 mb-2">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('index.note'); ?></label>
                                <?php echo Form::textarea('note', null, ['class' => 'form-control', 'id' => 'note', 'placeholder' => 'Note']); ?>

                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 mb-2">
                            <div class="form-group custom_table">
                                <label><?php echo app('translator')->get('index.add_a_file'); ?> (<?php echo app('translator')->get('index.max_size_5_mb'); ?>)</label>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="100%">
                                                <input type="hidden" name="file_old"
                                                    value="<?php echo e(isset($obj->file) && $obj->file ? $obj->file : ''); ?>">
                                                <?php echo Form::file('file_button', [
                                                    'class' => 'form-control file_checker_global',
                                                    'id' => 'file_button',
                                                    'accept' => 'image/png,image/jpeg,image/jgp,image/gif,application/pdf,.doc,.docx',
                                                    'data-this_file_size_limit' => '5',
                                                ]); ?>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                            <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.submit'); ?></button>
                            <a class="btn bg-second-btn" href="<?php echo e(route('productions.index')); ?>"><iconify-icon icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>

            <select id="ram_hidden" class="display_none" name="rmaterials_id">
                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                <?php $__currentLoopData = $rmaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option id="rmaterials_ids" class="rmaterials_ids" value="<?php echo e($value->id . '|' . $value->unit . '|' . getPurchaseSaleUnitById($value->consumption_unit) . '|' . $setting->currency . '|' . $value->rate_per_consumption_unit . '|' . $value->rate_per_unit . '|' . getPurchaseUnitByRMID($value->id)); ?>"><?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select id="noni_hidden" class="display_none" name="noninvemtory_id">
                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                <?php $__currentLoopData = $nonitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option id="noninvemtory_ids" class="noninvemtory_ids" value="<?php echo e($value->id . '|' . $value->nin_cost . '|' . $setting->currency); ?>">
                        <?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select id="stages_hidden" class="display_none" name="productionstage_id">
                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                <?php $__currentLoopData = $p_stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option id="noninvemtory_ids" class="noninvemtory_ids" value="<?php echo e($value->id . '|' . $value->nin_cost . '|' . $setting->currency); ?>">
                        <?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select id="account_hidden" class="display_none" name="account_id">
                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option id="account_id" class="account_id" value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select id="customers_hidden" class="display_none" name="customers_id">
                <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/addManufactures.js?v=2.1'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\manufacture\duplicateManufacture.blade.php ENDPATH**/ ?>