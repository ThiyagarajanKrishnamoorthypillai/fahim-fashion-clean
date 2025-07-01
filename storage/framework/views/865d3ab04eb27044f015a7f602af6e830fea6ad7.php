
<?php $__env->startSection('content'); ?>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    ?>
    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h3 class="top-left-header"><?php echo e(isset($title) && $title ? $title : ''); ?></h3>
                </div>
                <div class="col-sm-12 mb-2 col-md-3">
                </div>
                <div class="col-sm-12 mb-2 col-md-3">
                    <strong class="margin_10" id="stockValue"></strong>
                </div>
            </div>
        </section>


        <div class="box-wrapper">

            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <input type="hidden" class="datatable_name" data-filter="no" data-title="RM Stock"
                        data-id_name="datatable">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="w-10"><?php echo app('translator')->get('index.code'); ?></th>
                                <th class="w-30"><?php echo app('translator')->get('index.material_name'); ?></th>
                                <th class="w-20"><?php echo app('translator')->get('index.available_quantity'); ?></th>                                
                                <th class="w-20"><?php echo app('translator')->get('index.rate_per_unit'); ?> <i data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="<?php echo app('translator')->get('index.rm_stock_price_calculate'); ?>"
                                        class="fa fa-question-circle base_color c_pointer"></i></th>
                                <th class="w-15"><?php echo app('translator')->get('index.value'); ?>(<?php echo app('translator')->get('index.available_quantity'); ?> X <?php echo app('translator')->get('index.rate_per_unit'); ?>)</th>
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
                                    <td class="text-start"><?php echo e($i--); ?> </td>
                                    <td><?php echo e($value->code); ?></td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td>
                                        <?php echo e($value->current_stock_final); ?><?php if($value->consumption_check != 1): ?><?php echo e(str_replace(' ', '', getRMUnitById($value->unit))); ?><?php endif; ?>
                                    </td>
                                    <?php

                                        $grandT += $last_p_price * $value->current_stock;
                                    ?>                                    
                                    <td><?php echo e(getCurrency(number_format($last_p_price, 2, '.', ','))); ?></td>
                                    <td><?php echo e(getCurrency(number_format($last_p_price * $value->current_stock, 2, '.', ','))); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tr>
                            <th class="c_center"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo app('translator')->get('index.total'); ?>=</th>
                            <th><?php echo e(getCurrency(number_format($grandT, 2, '.', ','))); ?> <i data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="<?php echo app('translator')->get('index.rm_stock_price_calculate'); ?>"
                                    class="fa fa-question-circle base_color c_pointer"></i></th>
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
    <script src="<?php echo $baseURL . 'frequent_changing/js/lowStock.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\stock\lowStock.blade.php ENDPATH**/ ?>