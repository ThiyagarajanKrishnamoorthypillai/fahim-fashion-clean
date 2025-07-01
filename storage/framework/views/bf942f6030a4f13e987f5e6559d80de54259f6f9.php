<!-- shuvo -->
<link rel="stylesheet" href="<?php echo e(url('frequent_changing/css/report.css')); ?>">

<div class="main-content-wrapper">

    <div class="content-header">
        <h3 class="top-left-header"><?php echo app('translator')->get('index.sales_report'); ?></h3>
    </div>

    <div class="box-wrapper">
        <div class="text-right">
            <button class="dataFilterBy btn bg-blue-btn mb-2"><i class="fa fa-filter"></i><?php echo e(lang('filter_by')); ?></button>
        </div>
        <div>
            <h4><?php echo e(isset($outletName) && $outletName ? lang('outlet').':' . $outletName : ''); ?></h4>
            <h4>
                <?php if(!empty($start_date) && $start_date != '1970-01-01'): ?>
                    <?php echo e("Date: " . date($this->session->userdata('date_format'), strtotime($start_date))); ?>

                <?php endif; ?>
                <?php if(isset($start_date) && isset($end_date) && $start_date != '1970-01-01' && $end_date != '1970-01-01'): ?>
                    -
                <?php endif; ?>
                <?php if(!empty($end_date) && $end_date != '1970-01-01'): ?>
                    <?php echo e(date($this->session->userdata('date_format'), strtotime($end_date))); ?>

                <?php endif; ?>
            </h4>
        </div>
        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th><?php echo app('translator')->get('index.code'); ?></th>
                            <th><?php echo app('translator')->get('index.item_name'); ?></th>
                            <th><?php echo app('translator')->get('index.unit_price'); ?></th>
                            <th><?php echo app('translator')->get('index.quantity'); ?></th>
                            <th><?php echo app('translator')->get('index.discount'); ?></th>
                            <th><?php echo app('translator')->get('index.total'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($saleReport)): ?>
                            <?php
                                $total = 0;
                            ?>
                            <?php $__currentLoopData = $saleReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $total += $value->menu_price_with_discount;
                                    $key++;
                                ?>
                                <tr>
                                    <td class="text-start"><?php echo e($key); ?></td> 
                                    <td><?php echo e($value->code); ?></td>
                                    <td><?php echo e($value->menu_name); ?></td>
                                    <td><?php echo e(getAmtCustom($value->menu_unit_price)); ?></td>
                                    <td><?php echo e($value->totalQty); ?></td>
                                    <td><?php echo e(getAmtCustom($value->menu_discount_value)); ?></td>
                                    <td><?php echo e(getAmtCustom($value->menu_price_with_discount)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot> 
                        <tr>
                            <th class="text-start"><?php echo app('translator')->get('index.sn'); ?></th> 
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-end"><?php echo app('translator')->get('index.total'); ?>=</th>
                            <th><?php echo e(getAmtCustom($total ?? '0')); ?></th>
                        </tr>           
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>


<div class="filter-overlay"></div>
<div id="product-filter" class="filter-modal">
    <div class="filter-modal-body">
        <header>
                <h3 class="filter-modal-title"><?php echo app('translator')->get('index.FilterOptions'); ?></h3>
                <button class="close-filter-modal"><i class="fa fa-times"></i></button>
        </header>
        <?php echo Form::open(['url' => url('Report/saleReport'), 'id' => 'saleReport']); ?>

        <div class="col-sm-12 col-md-6 mb-2">
            <div class="form-group mx-2">
                <input tabindex="1" autocomplete="off" type="text" id="" name="startDate" readonly class="form-control customDatepicker" placeholder="<?php echo app('translator')->get('index.start_date'); ?>" value="<?php echo e(old('startDate')); ?>">
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="form-group mx-2">
                <input tabindex="2" autocomplete="off" type="text" id="endMonth" name="endDate" readonly class="form-control customDatepicker" placeholder="<?php echo app('translator')->get('index.end_date'); ?>" value="<?php echo e(old('endDate')); ?>">
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="form-group mx-2">
                <select tabindex="3" class="form-control select2 ir_w_100" name="selling_type">
                    <option <?php if($selling_type == 1): echo 'selected'; endif; ?> value="1"><?php echo app('translator')->get('index.top_selling'); ?></option>
                    <option <?php if($selling_type == 2): echo 'selected'; endif; ?> value="2"><?php echo app('translator')->get('index.less_selling'); ?></option>
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
                        <option <?php if(old('outlet_id') == $value->id): echo 'selected'; endif; ?> value="<?php echo e($value->id); ?>"><?php echo e($value->outlet_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <?php
            endif;
        ?> 
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="mx-2">
                <button type="submit" name="submit" value="submit" class="btn bg-blue-btn pull-left"><?php echo app('translator')->get('index.submit'); ?></button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>




<?php $this->view('updater/reuseJs')?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\saleReport.blade.php ENDPATH**/ ?>