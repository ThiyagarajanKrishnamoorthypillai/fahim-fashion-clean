
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
                            <th><?php echo app('translator')->get('index.customer'); ?></th>
                            <th><?php echo app('translator')->get('index.product'); ?></th>
                            <th><?php echo app('translator')->get('index.stock_method'); ?></th>
                            <th><?php echo app('translator')->get('index.consumed_time'); ?></th>
                            <th><?php echo app('translator')->get('index.total_cost'); ?></th>
                            <th><?php echo app('translator')->get('index.sale_price'); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if($obj && !empty($obj)): ?>
                        <?php 
                        $i = count($obj); 
                        $totalCost = 0;
                        $salePrice = 0;
                        ?>
                        <?php endif; ?>

                        <?php $__currentLoopData = $obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $totalCost = $totalCost + $value->mtotal_cost;
                        $salePrice = $salePrice + $value->msale_price;
                        ?>
                        <tr>
                            <td class="text-start"><?php echo e($i--); ?></td>
                            <td><?php echo e($value->customer->name ?? 'N/A'); ?></td>
                            <td><?php echo e(safe($value->product->name)); ?></td>
                            <td><?php echo e(stockMethod($value->product->stock_method)); ?></td>
                            <td><?php echo e(safe($value->consumed_time)); ?></td>
                            <td><?php echo e(safe(getAmtCustom($value->mtotal_cost))); ?></td>
                            <td><?php echo e(safe(getAmtCustom($value->msale_price))); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>                        
                        <th></th>
                        <th class="text-end"><?php echo app('translator')->get('index.total'); ?>=</th>
                        <th><?php echo e(getAmtCustom($totalCost)); ?></th>
                        <th><?php echo e(getAmtCustom($salePrice)); ?></th>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\fp_production_report.blade.php ENDPATH**/ ?>