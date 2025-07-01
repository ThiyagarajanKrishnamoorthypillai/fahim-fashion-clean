
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
            <?php echo e(Form::open(['route' => 'trial-balance', 'id' => 'attendance_form', 'method' => 'get'])); ?>

            <div class="row">
                <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                    <div class="form-group">
                        <?php echo Form::text('date', $date, [
                            'class' => 'form-control customDatepicker',
                            'readonly' => '',
                            'placeholder' => 'Select Date',
                        ]); ?>

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
                                <th class="op_width_2_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th><?php echo app('translator')->get('index.title'); ?></th>
                                <th><?php echo app('translator')->get('index.debit'); ?></th>
                                <th><?php echo app('translator')->get('index.credit'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="c_center">1</td>
                                <td><?php echo app('translator')->get('index.sale'); ?></td>
                                <td><?php echo e(getAmtCustom(0)); ?></td>
                                <td><?php echo e(getAmtCustom($sales_credit)); ?></td>
                            </tr>
                            <tr>
                                <td class="c_center">2</td>
                                <td><?php echo app('translator')->get('index.customer_due_received'); ?></td>
                                <td><?php echo e(getAmtCustom(0)); ?></td>
                                <td><?php echo e(getAmtCustom($customer_due_received_credit)); ?></td>
                            </tr>
                            <tr>
                                <td class="c_center">3</td>
                                <td><?php echo app('translator')->get('index.supplier_due_paid'); ?></td>
                                <td><?php echo e(getAmtCustom($supplier_due_paid_debit)); ?></td>
                                <td><?php echo e(getAmtCustom(0)); ?></td>
                            </tr>
                            <tr>
                                <td class="c_center">4</td>
                                <td><?php echo app('translator')->get('index.purchase'); ?></td>
                                <td><?php echo e(getAmtCustom($purchase_debit)); ?></td>
                                <td><?php echo e(getAmtCustom(0)); ?></td>
                            </tr>
                            <tr>
                                <td class="c_center">5</td>
                                <td><?php echo app('translator')->get('index.production_non_inventory_cost'); ?></td>
                                <td><?php echo e(getAmtCustom($production_non_inventory_cost_debit)); ?></td>
                                <td><?php echo e(getAmtCustom(0)); ?></td>
                            </tr>
                            <tr>
                                <td class="c_center">6</td>
                                <td><?php echo app('translator')->get('index.expense'); ?></td>
                                <td><?php echo e(getAmtCustom($expense_debit)); ?></td>
                                <td><?php echo e(getAmtCustom(0)); ?></td>
                            </tr>
                            <tr>
                                <td class="c_center">7</td>
                                <td><?php echo app('translator')->get('index.payroll'); ?></td>
                                <td><?php echo e(getAmtCustom($payroll_debit)); ?></td>
                                <td><?php echo e(getAmtCustom(0)); ?></td>
                            </tr>
                            <?php
                                $total_debit =
                                    $supplier_due_paid_debit +
                                    $purchase_debit +
                                    $production_non_inventory_cost_debit +
                                    $expense_debit +
                                    $payroll_debit;
                                $total_credit = $sales_credit + $customer_due_received_credit;
                            ?>
                            <tr>
                                <td class="c_center"></td>
                                <td class="fw-bold text-end"><?php echo app('translator')->get('index.total'); ?>=</td>
                                <td class="fw-bold"><?php echo e(getAmtCustom($total_debit)); ?></td>
                                <td class="fw-bold"><?php echo e(getAmtCustom($total_credit)); ?></td>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\trial_balance.blade.php ENDPATH**/ ?>