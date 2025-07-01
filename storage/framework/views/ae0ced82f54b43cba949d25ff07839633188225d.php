
<link rel="stylesheet" href="<?php echo e(url('frequent_changing/css/report.css')); ?>">
<div class="main-content-wrapper">

    <div class="content-header">
        <h3 class="top-left-header"><?php echo e(lang('customer_due_receive_report')); ?></h3>
    </div>

    

    <div class="box-wrapper">
        <div class="text-right">
            <button class="dataFilterBy btn bg-blue-btn mb-2"><i class="fa fa-filter"></i><?php echo e(lang('filter_by')); ?></button>
        </div>

        <div>
            <h4><?php echo e(isset($outletName) && $outletName ? lang('outlet').':' . escape_output($outletName) : ''); ?></h4>
            <h4>
                <?php if(!empty($start_date) && $start_date != '1970-01-01'): ?>
                    <?php echo e(date($this->session->userdata('date_format'), strtotime($start_date))); ?>

                <?php endif; ?>
                <?php if(isset($start_date) && isset($end_date) && $start_date != '1970-01-01' && $end_date != '1970-01-01'): ?>
                    -
                <?php endif; ?>
                <?php if(!empty($end_date) && $end_date != '1970-01-01'): ?>
                    <?php echo e(date($this->session->userdata('date_format'), strtotime($end_date))); ?>

                <?php endif; ?>
            </h4>
            <h4 class="op_center op_margin_top_0">
                <?php echo e(lang('customer')); ?>: 
                <span class="text_decoration_u">
                    <?php if(isset($customer_id) && $customer_id): ?>
                        <?php echo e(getName('tbl_customers', $customer_id)); ?>

                    <?php else: ?>
                        <?php echo e(lang('all')); ?>

                    <?php endif; ?>
                </span>
            </h4>
        </div>
        <div class="table-box">
            <div class="box-body">
                <div class="table-responsive">
                    
                    <table id="datatable"  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="op_width_20_p"> <?php echo app('translator')->get('index.customer'); ?></th>
                                <th class="op_width_20_p"> <?php echo app('translator')->get('index.amount'); ?></th>
                                <th class="op_width_20_p"> <?php echo app('translator')->get('index.date'); ?></th>
                                <th> <?php echo app('translator')->get('index.note'); ?></th>
                                <th> <?php echo app('translator')->get('index.received_by'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grandTotal = 0;
                            $countTotal = 0;
                            if (isset($customerDueReceive)):
                                foreach ($customerDueReceive as $key => $value) {
                                    $grandTotal+=$value->amount;
                                    $key++;
                                    ?>
                                    <tr>
                                        <td class="text-start"><?php echo e($key); ?></td>
                                        <td><?php echo e(getName('tbl_customers', $value->customer_id)); ?></td>
                                        <td><?php echo e(getAmtCustom($value->amount)); ?></td>
                                        <td><?php echo e(date($this->session->userdata('date_format'), strtotime($value->date))); ?></td>
                                        <td><?php echo e($value->note); ?></td>
                                        <td><?php echo e(userName($value->user_id)); ?></td>
                                    </tr>
                                    <?php
                                }
                            endif;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-start"></th>
                                <th class="text-end"><?php echo app('translator')->get('index.total'); ?>=</th>
                                <th><?= getAmtCustom($grandTotal) ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="filter-overlay"></div>
<div id="product-filter" class="filter-modal">
    <div class="filter-modal-body">
        <header>
                <h3 class="filter-modal-title"><?php echo app('translator')->get('FilterOptions'); ?></h3>
                <button class="close-filter-modal"><i class="fa fa-times"></i></button>
        </header>
        <?php echo e(form_open(base_url() . 'Report/customerDueReceiveReport')); ?>

        <div class="col-sm-12 col-md-6 mb-2">
            <div class="form-group mx-2">
                <input tabindex="1" autocomplete="off" type="text" id="" name="startDate" readonly class="form-control customDatepicker" placeholder="<?php echo e(lang('start_date')); ?>" value="<?php echo e(set_value('startDate')); ?>">
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="form-group mx-2">
                <input tabindex="2" autocomplete="off" type="text" id="endMonth" name="endDate" readonly class="form-control customDatepicker" placeholder="<?php echo e(lang('end_date')); ?>" value="<?php echo e(set_value('endDate')); ?>">
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="form-group mx-2">
                <select tabindex="2" class="form-control select2 op_width_100_p" id="customer_id" name="customer_id">
                    <option value=""><?php echo e(lang('customer')); ?></option>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php echo e(isset($customer_id) && $customer_id == $value->id ? 'selected' : ''); ?>><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <?php
            if(isLMni()):
        ?>
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="form-group mx-2">
                <select tabindex="2" class="form-control select2 ir_w_100" id="outlet_id" name="outlet_id">
                    <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php echo e(set_select('outlet_id', $value->id)); ?>><?php echo e($value->outlet_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <?php
            endif;
        ?>
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="mx-2">
                <button type="submit" name="submit" value="submit" class="btn bg-blue-btn pull-left"><?php echo e(lang('submit')); ?></button>
            </div>
        </div>
        <?php echo e(form_close()); ?>

    </div>
</div>

<?php $this->view('updater/reuseJs')?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\customerDueReceive.blade.php ENDPATH**/ ?>