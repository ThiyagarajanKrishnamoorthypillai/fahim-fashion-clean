
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
        <h4 class="ir_txtCenter_mt0"><span><?php echo app('translator')->get('index.supplier'); ?></span></h4>
        <h4 class="ir_txtCenter_mt0">
            <?php echo app('translator')->get('index.date'); ?>:
            <?php echo e(($startDate != '') ? getDateFormat($startDate) :''); ?>

            <?php echo e(($endDate != '') ? ' - '.getDateFormat($endDate):''); ?>

        </h4>
    </div>
    <?php endif; ?>


    <div class="box-wrapper">
        <?php echo e(Form::open(['route'=>'supplier-ledger', 'id' => "attendance_form", 'method'=>'GET'])); ?>

        <?php echo csrf_field(); ?>
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
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <select tabindex="-1" class="form-control select2" id="supplier_id" name="supplier_id" aria-hidden="true">
                        <option value=""><?php echo app('translator')->get('index.supplier'); ?></option>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php echo e(($supplier_id == $value->id) ? 'selected="selected"':''); ?>><?php echo e($value->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
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
                            <th><?php echo app('translator')->get('index.date'); ?></th>
                            <th><?php echo app('translator')->get('index.transaction_type'); ?></th>
                            <th><?php echo app('translator')->get('index.transaction_no'); ?></th>
                            <th><?php echo app('translator')->get('index.debit'); ?></th>
                            <th><?php echo app('translator')->get('index.credit'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grand_valance = 0;
                        $grand_debit = 0;
                        $grand_credit = 0;
                        $countTotal = 0;
                        $sum_of_grand_debit = 0;
                        $sum_of_grand_credit = 0;
                        ?>

                        <?php if(isset($type) && $type == 'All'): ?>
                            <?php
                            $balance = 0;
                            $sum_of_debit = 0;
                            $sum_of_credit = 0;
                            $i = count($supplierLedger);
                            ?>
                            <?php if(isset($supplierLedger) && $supplierLedger): ?>
                                <?php $__currentLoopData = $supplierLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(isset($sum_of_op_before_date) && $key == 0): ?>
                                        <?php if($sum_of_op_before_date > 0): ?>
                                            <?php
                                            $balance += $sum_of_op_before_date;
                                            $sum_of_debit += $sum_of_op_before_date;
                                            ?>
                                        <?php else: ?>
                                            <?php
                                            $balance -= abs($sum_of_op_before_date);
                                            $sum_of_credit += abs($sum_of_op_before_date);
                                            ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if($supplier->debit != 0): ?>
                                            <?php
                                            $balance += (float)$supplier->debit;
                                            $sum_of_debit += (float)$supplier->debit;
                                            ?>
                                        <?php else: ?>
                                            <?php
                                            $balance -= (float)$supplier->credit;
                                            $sum_of_credit += (float)$supplier->credit;
                                            ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td class="text-start"><?php echo e($i--); ?></td>
                                        <td><?php echo e($supplier->date != '' ? getDateFormat($supplier->date) : ''); ?></td>
                                        <td><?php echo e($supplier->type); ?></td>
                                        <td><?php echo e($supplier->reference_no); ?></td>
                                        <?php if(isset($sum_of_op_before_date) && $key == 0): ?>
                                            <td><?php echo e($sum_of_op_before_date > 0 ? getAmtCustom($sum_of_op_before_date) : 0); ?></td>
                                            <td><?php echo e($sum_of_op_before_date < 0 ? getAmtCustom(abs($sum_of_op_before_date)) : 0); ?></td>
                                        <?php else: ?>
                                            <td><?php echo e($supplier->debit != 0 ? getAmtCustom($supplier->debit) : 0); ?></td>
                                            <td><?php echo e($supplier->credit != 0 ? getAmtCustom($supplier->credit) : 0); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php elseif($type == 'Credit'): ?>
                            <?php
                            $balance = 0;
                            $sum_of_credit = 0;
                            ?>
                            <?php if(isset($supplierLedger) && $supplierLedger): ?>
                                <?php $__currentLoopData = $supplierLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($supplier->debit === '0' && $supplier->type != 'Opening Balance'): ?>
                                        <?php
                                        $sum_of_credit += $supplier->credit;
                                        ?>
                                        <tr>
                                            <td class="text-start"><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($supplier->date != '' ? getDateFormat($supplier->date) : ''); ?></td>
                                            <td><?php echo e($supplier->type); ?></td>
                                            <td><?php echo e($supplier->reference_no); ?></td>
                                            <?php if(isset($sum_of_op_before_date) && $key == 0): ?>
                                                <td><?php echo e($sum_of_op_before_date > 0 ? getAmtCustom($sum_of_op_before_date) : 0); ?></td>
                                                <td><?php echo e($sum_of_op_before_date < 0 ? getAmtCustom(abs($sum_of_op_before_date)) : 0); ?></td>
                                            <?php else: ?>
                                                <td></td>
                                                <td><?php echo e($supplier->credit != 0 ? getAmtCustom($supplier->credit) : 0); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php elseif($type == 'Debit'): ?>
                            <?php
                            $sum_of_debit = 0;
                            ?>
                            <?php if(isset($supplierLedger) && $supplierLedger): ?>
                                <?php $__currentLoopData = $supplierLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($supplier->credit === '0' && $supplier->type != 'Opening Balance'): ?>
                                        <?php
                                        $sum_of_debit += $supplier->debit;
                                        ?>
                                        <tr>
                                            <td class="text-start"><?php echo e($key + 1); ?></td>
                                            <td>
                                                <?php echo e($supplier->date != '' ? getDateFormat($supplier->date) : ''); ?>

                                            </td>
                                            <td><?php echo e($supplier->type); ?></td>
                                            <td><?php echo e($supplier->reference_no); ?></td>
                                            <?php if(isset($sum_of_op_before_date) && $key == 0): ?>
                                                <td><?php echo e($sum_of_op_before_date > 0 ? getAmtCustom($sum_of_op_before_date) : 0); ?></td>
                                                <td><?php echo e($sum_of_op_before_date < 0 ? getAmtCustom(abs($sum_of_op_before_date)) : 0); ?></td>
                                            <?php else: ?>
                                                <td><?php echo e($supplier->debit != 0 ? getAmtCustom($supplier->debit) : 0); ?></td>
                                                <td><?php echo e($supplier->credit != 0 ? getAmtCustom($supplier->credit) : 0); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\supplier_ledger.blade.php ENDPATH**/ ?>