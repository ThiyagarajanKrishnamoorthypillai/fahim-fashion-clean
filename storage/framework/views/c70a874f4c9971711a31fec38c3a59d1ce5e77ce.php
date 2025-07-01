<script src="<?php echo e(base_url()); ?>frequent_changing/js/customer_report.js"></script>
<link rel="stylesheet" href="<?php echo e(base_url()); ?>frequent_changing/css/report.css">    

<div class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header"><?php echo e(lang('customer_report')); ?></h3>
    </section>

    <div>
        <h4 class="op_center op_margin_top_o">
            <?php if(isset($customer_id) && $customer_id): ?>
                <span><?php echo e(getCustomerName($customer_id)); ?></span>
            <?php endif; ?>
        </h4>
        <h4>
            <?php if(isset($start_date) && $start_date && isset($end_date) && $end_date): ?>
                <?php echo e(lang('report_date')); ?> <?php echo e(date($this->session->userdata('date_format'), strtotime($start_date))); ?> - <?php echo e(date($this->session->userdata('date_format'), strtotime($end_date))); ?>

            <?php elseif(isset($start_date) && $start_date && !$end_date): ?>
                <?php echo e(lang('report_date')); ?> <?php echo e(date($this->session->userdata('date_format'), strtotime($start_date))); ?>

            <?php elseif(isset($end_date) && $end_date && !$start_date): ?>
                <?php echo e(lang('report_date')); ?> <?php echo e(date($this->session->userdata('date_format'), strtotime($end_date))); ?>

            <?php endif; ?>
        </h4>
    </div>

    <section class="box-wrapper">
        <div class="row mb-3">
            <div class="col-md-2 mb-3">
                <?php echo Form::open(base_url() . 'Report/customerReport', ['id' => 'customerReport']); ?>
                <div class="form-group">
                    <input tabindex="1" autocomplete="off" type="text" id="" name="startDate" readonly class="form-control customDatepicker" placeholder="<?php echo e(lang('start_date')); ?>" value="<?php echo e(set_value('startDate')); ?>">
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="form-group">
                    <input tabindex="2" autocomplete="off" type="text" id="endMonth" name="endDate" readonly class="form-control customDatepicker" placeholder="<?php echo e(lang('end_date')); ?>" value="<?php echo e(set_value('endDate')); ?>">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="form-group">
                    <select tabindex="2" class="form-control select2 op_width_100_p" id="customer_id" name="customer_id">
                        <option value=""><?php echo app('translator')->get('index.select_customer'); ?></option>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="alert alert-error error-msg customer_id_err_msg_contnr op_padding_5_important">
                    <p id="customer_id_err_msg"></p>
                </div>
            </div>
            <div class="col-md-1 mb-3">
                <div class="form-group">
                    <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><?php echo e(lang('submit')); ?></button>
                </div>
            </div>
        </div>

        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <h4 class="op_left op_margin_bottom_10"><?php echo app('translator')->get('index.sale'); ?></h4>
                <table class="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th><?php echo app('translator')->get('index.date'); ?></th>
                            <th><?php echo app('translator')->get('index.reference_no'); ?></th>
                            <th><?php echo app('translator')->get('index.details'); ?>; ?> (<?php echo app('translator')->get('index.Name_Price_Qty'); ?>);</th>
                            <th><?php echo app('translator')->get('index.g_total'); ?></th>
                            <th><?php echo app('translator')->get('index.paid'); ?></th>
                            <th><?php echo app('translator')->get('index.due'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pGrandTotal = 0;
                        $pPaid = 0;
                        $pDue = 0;
                        ?>
                        <?php if(isset($customerReport)): ?>
                            <?php $__currentLoopData = $customerReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $pGrandTotal += $value->total_payable;
                                $pPaid += $value->paid_amount;
                                $pDue += $value->due_amount;
                                $key++;
                                ?>
                                <tr>
                                    <td class="text-start"><?php echo e($key); ?></td>
                                    <td><?php echo e(getDateFormat($value->sale_date)); ?></td>
                                    <td><?php echo e($value->sale_no); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $value->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($item->name . " - " . $item->price . " - " . $item->qty); ?>

                                            <?php if($k1 < (count($value->items) - 1)): ?>
                                                <br>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e(getAmtCustom($value->total_payable)); ?></td>
                                    <td><?php echo e(getAmtCustom($value->paid_amount)); ?></td>
                                    <td><?php echo e(getAmtCustom($value->due_amount)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <th class="text-start"></th>
                        <th></th>
                        <th></th>
                        <th class="op_right"><?php echo app('translator')->get('index.total'); ?></th>
                        <th><?= getAmtCustom($pGrandTotal) ?></th>
                        <th><?php echo e(getAmtCustom($pPaid)); ?></th>
                        <th><?php echo e(getAmtCustom($pDue)); ?></th>
                    </tfoot>
                </table>
                <br>
                <h4 class="op_left op_margin_bottom_10"><?php echo app('translator')->get('index.due_receive'); ?></h4>
                <table class="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="op_width_2_p op_center"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th><?php echo app('translator')->get('index.date'); ?></th>
                            <th><?php echo app('translator')->get('index.receive_amount'); ?></th>
                            <th class="op_width_45_p"><?php echo app('translator')->get('index.note'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalAmount = 0;
                        ?>
                        <?php if(isset($customerDueReceiveReport)): ?>
                            <?php $__currentLoopData = $customerDueReceiveReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $totalAmount += $value->amount;
                                $key++;
                                ?>
                                <tr>
                                    <td class="op_center"><?php echo e($key); ?></td>
                                    <td><?php echo e(getDateFormat($value->date)); ?></td>
                                    <td><?php echo e(getAmtCustom($value->amount)); ?></td>
                                    <td><?php echo e($value->note); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <th class="op_width_2_p op_center"></th>
                        <th class="op_right"><?php echo app('translator')->get('index.total'); ?></th>
                        <th><?php echo e(getAmtCustom($totalAmount)); ?></th>
                        <th></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>


<?php $this->view('updater/reuseJs'); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\customerReport.blade.php ENDPATH**/ ?>