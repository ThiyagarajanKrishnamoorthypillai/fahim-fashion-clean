
<?php $__env->startSection('content'); ?>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
    ?>
    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header"><?php echo e(isset($title) && $title ? $title : ''); ?></h2>
                    <input type="hidden" class="datatable_name" data-title="<?php echo e(isset($title) && $title ? $title : ''); ?>"
                        data-id_name="datatable">
                </div>
                <div class="col-md-offset-4 col-md-2">

                </div>
            </div>
        </section>
        <div class="box-wrapper">
            <?php echo e(Form::open(['route' => 'rm-stock-report', 'id' => 'attendance_form', 'method' => 'get'])); ?>

            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                    <div class="form-group">
                        <select name="category_id" class="form-control select2">
                            <option value=""><?php echo app('translator')->get('index.select_raw_materials'); ?></option>
                            <?php $__currentLoopData = $rmCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($category_id == $value->id ? 'selected' : ''); ?> value="<?php echo e($value->id); ?>">
                                    <?php echo e($value->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                    <div class="form-group">
                        <select name="finish_p_id" class="form-control select2">
                            <option value=""><?php echo app('translator')->get('index.select_product'); ?></option>
                            <?php $__currentLoopData = $finishProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"
                                    <?php echo e(isset($obj->name) && $obj->name == $value->id ? 'selected' : ''); ?>><?php echo e($value->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <button type="submit" name="submit" value="submit" class="btn bg-blue-btn w-100"><?php echo app('translator')->get('index.submit'); ?></button>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>

            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.code'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.material_name'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.quantity'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.rate_per_unit'); ?></th>
                                <th class="w-25"><?php echo app('translator')->get('index.value'); ?>(<?php echo app('translator')->get('index.quantity'); ?> X <?php echo app('translator')->get('index.rate_per_unit'); ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($obj && !empty($obj)): ?>
                                <?php
                                $i = count($obj);
                                ?>
                            <?php endif; ?>
                            <?php
                            $totalStock = 0;
                            $grandTotal = 0;
                            $grandT = 0;
                            ?>
                            <?php $__currentLoopData = $obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                
                                $totalStock = $value->total_purchase - $value->total_rm_waste;
                                $totalStock = getAdjustData($totalStock, $value->id);
                                $last_p_price = getLastThreePurchasePrice($value->id);
                                if ($last_p_price) {
                                    $totalTK = $totalStock * $last_p_price;
                                }
                                if ($totalStock >= 0) {
                                    if ($value->conversion_rate == 0 || $value->conversion_rate == '') {
                                        $grandTotal = $grandTotal + $totalStock * ($last_p_price / 1);
                                    } else {
                                        $grandTotal = $grandTotal + $totalStock * round($last_p_price / $value->conversion_rate, 2);
                                    }
                                }
                                if ($value->conversion_rate == 0 || $value->conversion_rate == '') {
                                    $total = $totalStock * ($last_p_price / 1);
                                } else {
                                    $total = $totalStock * round($last_p_price / $value->conversion_rate, 2);
                                }
                                
                                if ($value->conversion_rate == 0 || $value->conversion_rate == '') {
                                    $total_sale_unit = getRawMaterialUseInManufacture($value->id);
                                } else {
                                    $total_sale_unit = getRawMaterialUseInManufacture($value->id);
                                }
                                ?>
                                <tr>
                                    <td class="text-start"><?php echo e($i--); ?></td>
                                    <td><?php echo e($value->code); ?></td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td>
                                        <?php echo e($value->current_stock_final); ?><?php if($value->consumption_check != 1): ?><?php echo e(getRMUnitById($value->unit)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <?php

                                        $grandT += $last_p_price * $value->current_stock;
                                    ?>
                                    <td><?php echo e(getAmtCustom($last_p_price)); ?></td>
                                    <td><?php echo e(getAmtCustom($last_p_price * $value->current_stock)); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tr>
                            <th class="c_center"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-end"><?php echo app('translator')->get('index.total'); ?>=</th>
                            <th><?php echo e(getAmtCustom($grandT)); ?>

                            </th>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo $baseURL . 'assets/datatable_custom/jquery-3.3.1.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/dataTables.bootstrap4.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/dataTables.buttons.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/buttons.html5.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/buttons.print.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/jszip.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/pdfmake.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/vfs_fonts.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/newDesign/js/forTable.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/js/custom_report.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\rm_stock_report.blade.php ENDPATH**/ ?>