
<?php $__env->startSection('content'); ?>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    ?>
    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h3 class="top-left-header"><?php echo e(isset($title) && $title ? $title : ''); ?></h3>
                </div>
                <div class="col-sm-12 mb-2 col-md-3">
                </div>
                <div class="col-sm-12 mb-2 col-md-3">
                    <strong class="margin_10" id="stockValue"></strong>
                </div>
            </div>
        </section>


        <div class="box-wrapper">

            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <input type="hidden" class="datatable_name" data-filter="yes" data-title="RM Stock"
                        data-id_name="datatable">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="w-10"><?php echo app('translator')->get('index.code'); ?></th>
                                <th class="w-30"><?php echo app('translator')->get('index.material_name'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.available_quantity'); ?></th>
                                <th class="w-10"><?php echo app('translator')->get('index.floating_stock'); ?>
                                    <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('index.floating_stock_details'); ?>"
                                        class="fa fa-question-circle base_color c_pointer"></i>
                                </th>
                                <th class="w-15"><?php echo app('translator')->get('index.rate_per_unit'); ?> <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="<?php echo app('translator')->get('index.rm_stock_price_calculate'); ?>" class="fa fa-question-circle base_color c_pointer"></i>
                                </th>
                                <th class="w-15"><?php echo app('translator')->get('index.value'); ?>(<?php echo app('translator')->get('index.available_quantity'); ?> X <?php echo app('translator')->get('index.rate_per_unit'); ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($obj && !empty($obj)): ?>
                                <?php
                                $i = count($obj);
                                ?>
                            <?php endif; ?>
                            <?php
                            $totalStock = 0;
                            $grandTotal = 0;
                            $grandT = 0;
                            ?>
                            <?php $__currentLoopData = $obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                
                                $totalStock = $value->total_purchase - $value->total_rm_waste;
                                $totalStock = getAdjustData($totalStock, $value->id);
                                $last_p_price = getLastThreePurchasePrice($value->id);
                                if ($last_p_price) {
                                    $totalTK = $totalStock * $last_p_price;
                                }
                                if ($totalStock >= 0) {
                                    if ($value->conversion_rate == 0 || $value->conversion_rate == '') {
                                        $grandTotal = $grandTotal + $totalStock * ($last_p_price / 1);
                                    } else {
                                        $grandTotal = $grandTotal + $totalStock * round($last_p_price / $value->conversion_rate, 2);
                                    }
                                }
                                if ($value->conversion_rate == 0 || $value->conversion_rate == '') {
                                    $total = $totalStock * ($last_p_price / 1);
                                } else {
                                    $total = $totalStock * round($last_p_price / $value->conversion_rate, 2);
                                }
                                
                                if ($value->conversion_rate == 0 || $value->conversion_rate == '') {
                                    $total_sale_unit = getRawMaterialUseInManufacture($value->id);
                                } else {
                                    $total_sale_unit = getRawMaterialUseInManufacture($value->id);
                                }
                                ?>
                                <tr>
                                    <td class="text-start"><?php echo e($i--); ?> </td>
                                    <td><?php echo e($value->code); ?></td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td>
                                        <?php echo e($value->current_stock_final); ?><?php if($value->consumption_check != 1): ?><?php echo e(str_replace(' ', '', getRMUnitById($value->unit))); ?><?php endif; ?>
                                    </td>
                                    <?php

                                        $grandT += $last_p_price * $value->current_stock;
                                    ?>
                                    <td><?php echo e(getFloatingStockRawMaterialId($value->id, $manufacture_id)); ?><?php echo e(getManufactureUnitByRMID($value->id)); ?>

                                    </td>
                                    <td><?php echo e(getAmtCustom($last_p_price)); ?></td>
                                    <td><?php echo e(getAmtCustom($last_p_price * $value->current_stock)); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tr>
                            <th class="c_center"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo app('translator')->get('index.total'); ?>=</th>
                            <th><?php echo e(getAmtCustom($grandT)); ?> <i data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="<?php echo app('translator')->get('index.sum_of_all_values'); ?>"
                                    class="fa fa-question-circle base_color c_pointer"></i></th>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="modal fade" id="filterModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('index.rm_stocks'); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo Form::model(isset($obj) && $obj ? $obj : '', [
                            'id' => 'add_form',
                            'method' => isset($obj) && $obj ? 'POST' : 'POST',
                            'enctype' => 'multipart/form-data',
                            'route' => ['getRMStock'],
                        ]); ?>

                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('index.product'); ?> </label>
                                    <select name="finish_p_id" id="finish_p_id" class="form-control select2">
                                        <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                        <?php $__currentLoopData = $finishProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"
                                                <?php echo e($product_id == $value->id ? 'selected' : ''); ?>>
                                                <?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('index.floating_stock_by_manufacture'); ?> </label>
                                    <select name="manufacture_id" id="manufacture_id" class="form-control select2">
                                        <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                        <?php $__currentLoopData = $manufactureProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"
                                                <?php echo e(isset($obj->name) && $obj->name == $value->id ? 'selected' : ''); ?>>
                                                <?php echo e($value->reference_no); ?> - <?php echo e($value->product->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2 mt-3">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#multipleProductModal"
                                    class="btn w-100 bg-blue-btn manufacture_by_requirement"><?php echo app('translator')->get('index.by_manufacture_requirement'); ?></button>
                            </div>

                            <div class="col-md-4 mb-2 subBtn">
                                <button type="submit" name="submit" value="submit"
                                    class="btn w-100 bg-blue-btn"><?php echo app('translator')->get('index.submit'); ?></button>
                            </div>

                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>

        
        <div class="modal fade" id="multipleProductModal" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <?php echo Form::model(isset($obj) && $obj ? $obj : '', [
                    'id' => 'add_form',
                    'method' => isset($obj) && $obj ? 'POST' : 'POST',
                    'enctype' => 'multipart/form-data',
                    'route' => ['getRMStock'],
                ]); ?>

                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            <?php echo app('translator')->get('index.select_product'); ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i data-feather="x"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row" id="product_list">
                            <div class="col-sm-12 mb-2 col-md-5">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('index.product'); ?> <span class="required_star">*</span></label>
                                    <select tabindex="4"
                                        class="form-control select2 select2-hidden-accessible productModal" name="product"
                                        id="productModal">
                                        <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                                        <?php $__currentLoopData = $finishProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($p->id); ?>|<?php echo e($p->name); ?>(<?php echo e($p->code); ?>)">
                                                <?php echo e($p->name); ?>(<?php echo e($p->code); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="text-danger productErr"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2 col-md-5">
                                <label class="custom_label"><?php echo app('translator')->get('index.quantity'); ?> <span
                                        class="required_star">*</span></label>
                                <div class="input-group">
                                    <input type="number" autocomplete="off" min="1"
                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk1"
                                        onfocus="select();" name="qty_modal_product" id="qty_modal_product"
                                        placeholder="Quantity" value="1">
                                    <span class="input-group-text modal_unit_name" id="basic-addon2">Piece</span>
                                </div>
                                <div class="text-danger qtyErr"></div>
                            </div>
                            <div class="col-sm-12 mb-2 col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button class="btn bg-blue-btn" type="button" id="add_product_to_cart">
                                        <iconify-icon icon="solar:add-circle-broken"></iconify-icon><?php echo app('translator')->get('index.add'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="stock_table" class="d-none">
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-20"><?php echo app('translator')->get('index.name'); ?></th>
                                        <th class="w-20"><?php echo app('translator')->get('index.quantity'); ?></th>
                                        <th class="w-5 text-end"><?php echo app('translator')->get('index.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="cart_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-btn" value="submit"
                            id="submit_multi_product"><iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.submit'); ?>
                        </button>
                    </div>
                </div>
                <?php echo Form::close(); ?>

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
    <script src="<?php echo $baseURL . 'frequent_changing/js/stock.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/js/stockCheck.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\stock\stocks.blade.php ENDPATH**/ ?>