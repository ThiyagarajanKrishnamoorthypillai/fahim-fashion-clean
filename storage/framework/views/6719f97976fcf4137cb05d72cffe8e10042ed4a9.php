
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
        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th><?php echo app('translator')->get('index.reference_no'); ?></th>
                            <th><?php echo app('translator')->get('index.date'); ?></th>
                            <th><?php echo app('translator')->get('index.customer'); ?></th>
                            <th><?php echo app('translator')->get('index.g_total'); ?></th>
                            <th><?php echo app('translator')->get('index.paid'); ?></th>
                            <th><?php echo app('translator')->get('index.due'); ?></th>
                            <th><?php echo app('translator')->get('index.status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($obj && !empty($obj)): ?>
                        <?php 
                        $i = count($obj);
                        $total = 0;
                        $paid = 0;
                        $due = 0;
                         ?>
                        <?php endif; ?>

                        <?php $__currentLoopData = $obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $total = $total + $value->grand_total;
                        $paid = $paid + $value->paid;
                        $due = $due + $value->due;
                        ?>
                        <tr>
                            <td class="text-start"><?php echo e($i--); ?></td>
                            <td><?php echo e($value->reference_no); ?></td>
                            <td><?php echo e(getDateFormat($value->sale_date)); ?></td>
                            <td><?php echo e($value->customer->name ?? 'N/A'); ?></td>
                            <td><?php echo e(getAmtCustom($value->grand_total)); ?></td>
                            <td><?php echo e(getAmtCustom($value->paid)); ?></td>
                            <td><?php echo e(getAmtCustom($value->due)); ?></td>
                            <td><?php echo e($value->status); ?></td>
                        </tr>                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot> 
                        <tr>
                            <th class="op_width_2_p op_center"><?php echo app('translator')->get('index.sn'); ?></th> 
                            <th></th>
                            <th></th>
                            <th class="text-end"><?php echo app('translator')->get('index.total'); ?>=</th>
                            <th><?php echo e(getAmtCustom(isset($total) && $total?$total:'0')); ?></th>
                            <th><?php echo e(getAmtCustom($paid)); ?></th>
                            <th><?php echo e(getAmtCustom($due)); ?></th>
                        </tr>           
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\fp_sale_report.blade.php ENDPATH**/ ?>