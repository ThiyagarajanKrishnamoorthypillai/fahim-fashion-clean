
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
    <?php if($startDate != '' || $endDate != ''): ?>
    <div class="my-2">
        <h4 class="ir_txtCenter_mt0">
            Date:
            <?php echo e(($startDate != '') ? getDateFormat($startDate):''); ?>

            <?php echo e(($endDate != '') ? ' - '.getDateFormat($endDate):''); ?>

        </h4>
    </div>
    <?php endif; ?>

    <div class="box-wrapper">
        <?php echo e(Form::open(['route'=>'rm-purchase-report', 'id' => "attendance_form", 'method'=>'get'])); ?>

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
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-start w-5"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th class="w-10"><?php echo app('translator')->get('index.reference_no'); ?></th>
                            <th class="w-5"><?php echo app('translator')->get('index.date'); ?></th>
                            <th class="w-10"><?php echo app('translator')->get('index.supplier'); ?></th>
                            <th class="w-10"><?php echo app('translator')->get('index.g_total'); ?></th>
                            <th class="w-10"><?php echo app('translator')->get('index.paid'); ?></th>
                            <th class="w-10"><?php echo app('translator')->get('index.due'); ?></th>
                            <th class="w-40"><?php echo app('translator')->get('index.items'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($obj && !empty($obj)): ?>
                        <?php
                        $i = count($obj);
                        $grandTotal = 0;
                        $paid = 0;
                        $due = 0;
                        ?>
                        <?php endif; ?>
                        <?php $__currentLoopData = $obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $grandTotal += $value->grand_total;
                        $paid += $value->paid;
                        $due += $value->due;
                        ?>
                        <tr>
                            <td class="text-start"><?php echo e($i--); ?></td>
                            <td><?php echo e($value->reference_no); ?></td>
                            <td><?php echo e(getDateFormat($value->date)); ?></td>
                            <td><?php echo e(getSupplierName($value->supplier)); ?></td>
                            <td><?php echo e(getAmtCustom($value->grand_total)); ?></td>
                            <td><?php echo e(getAmtCustom($value->paid)); ?></td>
                            <td><?php echo e(getAmtCustom($value->due)); ?></td>
                            <td><?php echo getRMPurchaseItems($value->id); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-end"><?php echo app('translator')->get('index.total'); ?>=</th>
                        <th><?php echo e(getAmtCustom($grandTotal)); ?></th>
                        <th><?php echo e(getAmtCustom($paid)); ?></th>
                        <th><?php echo e(getAmtCustom($due)); ?></th>
                        <th></th>
                    </tfoot>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\rm_item_purchase_report.blade.php ENDPATH**/ ?>