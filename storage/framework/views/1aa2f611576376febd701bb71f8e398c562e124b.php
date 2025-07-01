
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
        <?php echo e(Form::open(['route'=>'supplier-due-report', 'id' => "attendance_form", 'method'=>'get'])); ?>

        <div class="row">
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <select class="form-control select2 op_width_100_p" id="type" name="type">
                        <option value="All" <?php echo e(($type == "All") ? 'selected="selected"':''); ?>><?php echo app('translator')->get('index.all'); ?></option>
                        <option value="Debit" <?php echo e(($type == "Debit") ? 'selected="selected"':''); ?>><?php echo app('translator')->get('index.debit'); ?></option>
                        <option value="Credit" <?php echo e(($type == "Credit") ? 'selected="selected"':''); ?>><?php echo app('translator')->get('index.credit'); ?></option>
                    </select>
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
                            <th class="text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th><?php echo app('translator')->get('index.supplier'); ?></th>
                            <th><?php echo app('translator')->get('index.current_balance'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandCredit = 0;
                        $grandDebit = 0;
                        $i = count($supplierDueReport)-1;
                        ?>

                        <?php if(isset($type) && $type == 'Credit'): ?>
                            <?php if(isset($supplierDueReport)): ?>
                                <?php $__currentLoopData = $supplierDueReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $totalDue = getSupplierDue($value->id);
                                    ?>
                                    <?php if($totalDue != 0 && $totalDue > 0): ?>
                                        <?php
                                        $grandCredit += $totalDue;
                                        ?>
                                        <tr>
                                            <td class="text-start"><?php echo e($i--); ?></td>
                                            <td class="text-left"><?php echo e($value->name); ?></td>
                                            <td class="text-left"><?php echo e(getAmtCustom(abs($totalDue))); ?> (<?php echo app('translator')->get('index.credit'); ?>)</td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <tr>
                                <th class="op_width_2_p op_center"></th>
                                <th class="text-end"><?php echo app('translator')->get('index.total_credit_amount'); ?>=</th>
                                <th><?php echo e($grandCredit == 0 ? '' : getAmtCustom(abs($grandCredit))); ?></th>
                            </tr>
                        <?php elseif(isset($type) && $type == 'Debit'): ?>
                            <?php if(isset($supplierDueReport)): ?>
                                <?php $__currentLoopData = $supplierDueReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $totalDue = getSupplierDue($value->id);
                                    ?>
                                    <?php if($totalDue != 0 && $totalDue < 0): ?>
                                        <?php
                                        $grandDebit += $totalDue;
                                        ?>
                                        <tr>
                                            <td class="text-start"><?php echo e($i--); ?></td>
                                            <td class="text-left"><?php echo e($value->name); ?></td>
                                            <td class="text-left"><?php echo e(getAmtCustom(abs($totalDue))); ?>(<?php echo app('translator')->get('index.debit'); ?>)</td>
                                        </tr>                                        
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <tr>
                                <th class="op_width_2_p op_center"></th>
                                <th class="text-end"><?php echo app('translator')->get('index.total_debit_amount'); ?>=</th>
                                <th><?php echo e($grandDebit == 0 ? '' : getAmtCustom(abs($grandDebit))); ?></th>
                            </tr>
                        <?php else: ?>
                            <?php if(isset($supplierDueReport)): ?>
                                <?php $__currentLoopData = $supplierDueReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $totalDue = getSupplierDue($value->id);
                                    ?>
                                    <?php if($totalDue != 0): ?>
                                        <tr>
                                            <td class="text-start"><?php echo e($i--); ?></td>
                                            <td class="text-left"><?php echo e($value->name); ?></td>
                                            <?php if($totalDue > 0): ?>
                                                <?php
                                                $grandCredit += $totalDue;
                                                ?>
                                                <td class="text-left"><?php echo e(getAmtCustom(abs($totalDue))); ?> (<?php echo app('translator')->get('index.credit'); ?>)</td>
                                            <?php elseif($totalDue < 0): ?>
                                                <?php
                                                $grandDebit += $totalDue;
                                                ?>
                                                <td class="text-left"><?php echo e(getAmtCustom(abs($totalDue))); ?>(<?php echo app('translator')->get('index.debit'); ?>)</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <tr>
                                <th class="op_width_2_p op_center"></th>
                                <th class="text-end"><?php echo app('translator')->get('index.total_credit_amount'); ?>=</th>
                                <th><?php echo e($grandCredit == 0 ? '' : getAmtCustom(abs($grandCredit))); ?></th>
                            </tr>
                            <tr>
                                <th class="op_width_2_p op_center"></th>
                                <th class="text-end"><?php echo app('translator')->get('index.total_debit_amount'); ?>=</th>
                                <th><?php echo e($grandDebit == 0 ? '' : getAmtCustom(abs($grandDebit))); ?></th>
                            </tr>
                        <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\supplier_due_report.blade.php ENDPATH**/ ?>