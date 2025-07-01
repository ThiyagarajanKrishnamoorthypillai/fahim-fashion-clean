
<?php $__env->startSection('content'); ?>
<?php
$baseURL = getBaseURL();
$setting = getSettingsInfo();
$base_color = "#6ab04c";
if (isset($setting->base_color) && $setting->base_color) {
    $base_color = $setting->base_color;
}
?>
<section class="main-content-wrapper">
    <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="top-left-header"><?php echo e(isset($title) && $title?$title:''); ?></h2>
                <input type="hidden" class="datatable_name" data-title="<?php echo e(isset($title) && $title?$title:''); ?>" data-id_name="datatable">
            </div>
            <div class="col-md-offset-4 col-md-2">

            </div>
        </div>
    </section>
    <div class="box-wrapper">
        <?php echo e(Form::open(['route'=>'profit-loss-report', 'id' => "attendance_form", 'method'=>'get'])); ?>

        <div class="row">
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo Form::text('startDate', $startDate, ['class' => 'form-control customDatepicker', 'readonly'=>"", 'placeholder'=>"Start Date"]); ?>

                </div>
            </div>
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo Form::text('endDate', $endDate, ['class' => 'form-control customDatepicker', 'readonly'=>"", 'placeholder'=>"End Date"]); ?>

                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="form-group">
                    <button type="submit" value="submit" class="btn bg-blue-btn w-100"><?php echo app('translator')->get('index.submit'); ?></button>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>


        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table class="table" id="datatable" data-ordering="false">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="ir_w_100 text-center">
                                <h4 class="ir_txt_center"><?php echo app('translator')->get('index.profit_loss_report'); ?></h4>
                                <?php if($startDate != '' || $endDate != ''): ?>
                                <h4 class="ir_txtCenter_mt0">
                                    <?php echo app('translator')->get('index.date'); ?>
                                    <?php echo e(($startDate != '') ? getDateFormat($startDate):''); ?>

                                    <?php echo e(($endDate != '') ? ' - '.getDateFormat($endDate):''); ?>

                                </h4>
                                <?php endif; ?>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="ir_w_40"><?php echo app('translator')->get('index.total_sales'); ?> (<?php echo app('translator')->get('index.paid_unpaid'); ?>) (<?php echo app('translator')->get('index.inc_tax'); ?>)</td>
                            <td><?php echo e(isset($totalSales) ? getAmtCustom($totalSales) : getAmtCustom(0)); ?></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><?php echo app('translator')->get('index.total_cost_goods_sold'); ?> (<?php echo app('translator')->get('index.based_on_average_price'); ?>)</td>
                            <td><?php echo e(isset($totalCostOfGoodsSold) ? getAmtCustom($totalCostOfGoodsSold) : getAmtCustom(0)); ?></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><?php echo app('translator')->get('index.total_cost_of_transferred_item'); ?> (<?php echo app('translator')->get('index.based_on_average_price'); ?>)</td>
                            <td><?php echo e(isset($totalCostOfTransferred) ? getAmtCustom($totalCostOfTransferred) : getAmtCustom(0)); ?></td>
                        </tr>
                        <tr class="profit_txt">
                            <td>4</td>
                            <td><?php echo app('translator')->get('index.gross_profit'); ?></td>
                            <td> <?php echo e(isset($grossProfit) ? getAmtCustom($grossProfit) : getAmtCustom(0)); ?></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><?php echo app('translator')->get('index.total_tax'); ?></td>
                            <td><?php echo e(isset($totalTaxAmount) ? getAmtCustom($totalTaxAmount) : getAmtCustom(0)); ?></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><?php echo app('translator')->get('index.total_waste'); ?></td>
                            <td><?php echo e(isset($total_waste) ? getAmtCustom($total_waste) : getAmtCustom(0)); ?></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><?php echo app('translator')->get('index.total_expense'); ?></td>
                            <td><?php echo e(isset($total_expense) ? getAmtCustom($total_expense) : getAmtCustom(0)); ?></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><?php echo app('translator')->get('index.total_refund'); ?></td>
                            <td><?php echo e(isset($saleReportByDate['profit_8_1']) ? getAmt($saleReportByDate['profit_8_1']) : getAmt(0)); ?></td>
                        </tr>
                        <tr class="profit_txt">
                            <td>9</td>
                            <td><?php echo app('translator')->get('index.net_profit'); ?></td>
                            <td><?php echo e(isset($netProfit) ? getAmtCustom($netProfit) : getAmtCustom(0)); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo $baseURL.'assets/datatable_custom/jquery-3.3.1.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/jquery.dataTables.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/dataTables.bootstrap4.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/dataTables.buttons.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/buttons.html5.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/buttons.print.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/jszip.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/pdfmake.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/vfs_fonts.js'; ?>"></script>
<script src="<?php echo $baseURL.'frequent_changing/newDesign/js/forTable.js'; ?>"></script>
<script src="<?php echo $baseURL.'frequent_changing/js/custom_report.js'; ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\profit_loss_report.blade.php ENDPATH**/ ?>