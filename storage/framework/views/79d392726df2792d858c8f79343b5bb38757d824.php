
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
        <?php echo e(Form::open(['route'=>'customer-ledger', 'id' => "attendance_form", 'method'=>'get'])); ?>

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
                    <?php echo Form::select('customer_id', $customers, $customer_id, ['class' => 'form-control select2', ]); ?>

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
                        $creditBalance = 0;
                        $debitBalance = 0;
                        $closing_result = 0;
                    ?>
                        <?php $__currentLoopData = $customerLedger; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $creditBalance += $ledger['credit'];
                                $debitBalance += $ledger['debit'];
                                $closing_result = $debitBalance - $creditBalance;
                            ?>
                            <tr>
                                <td class="text-start"><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(getDateFormat($ledger['date'])); ?></td>
                                <td><?php echo e($ledger['type']); ?></td>
                                <td><?php echo e($ledger['transaction_no']); ?></td>
                                <td><?php echo e(getAmtCustom($ledger['debit'])); ?></td>
                                <td><?php echo e(getAmtCustom($ledger['credit'])); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-end"><?php echo app('translator')->get('index.closing_balance'); ?>=</th>                           
                            <th><?php echo e(($closing_result > 0) ? getAmtCustom(abs($closing_result)):0); ?></th>
                            <th><?php echo e(($closing_result < 0) ? getAmtCustom(abs($closing_result)):0); ?></th>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\customer_ledger.blade.php ENDPATH**/ ?>