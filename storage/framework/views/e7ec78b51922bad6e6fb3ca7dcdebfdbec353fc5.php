<div>
    <div class="row">
        <div class="col-sm-12 col-md-6 mb-2 col-lg-4">
            <div class="form-group">
                <label><?php echo app('translator')->get('index.reference_no'); ?> <span class="required_star">*</span></label>

                <input type="text" name="reference_no" id="code"
                    class="check_required form-control <?php $__errorArgs = ['reference_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Reference No" value="<?php echo e(isset($obj->reference_no) ? $obj->reference_no : $ref_no); ?>"
                    onfocus="select()" readonly>

                <?php $__errorArgs = ['reference_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-2 col-lg-4">
            <div class="form-group">
                <label><?php echo app('translator')->get('index.date'); ?> <span class="required_star">*</span></label>
                <input type="text" name="date" id="date"
                    class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> customDatepicker" readonly
                    placeholder="Date" value="<?php echo e(isset($obj->date) ? $obj->date : old('date')); ?>">
                <p class="text-danger d-none m-0" id="date_error"></p>
                <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="col-sm-12 mb-2 col-md-4">
            <div class="form-group">
                <label><?php echo app('translator')->get('index.responsible_person'); ?> <span class="required_star">*</span></label>
                <select name="responsible_person" id="res_person"
                    class="form-control <?php $__errorArgs = ['responsible_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2">
                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>"
                            <?php echo e(isset($obj->responsible_person) && $obj->responsible_person == $value->id || old('responsible_person') == $value->id ? 'selected' : ''); ?>>
                            <?php echo e($value->name); ?> (<?php echo e($value->phone_number); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p class="text-danger d-none m-0" id="res_person_error"></p>
            </div>
            <?php $__errorArgs = ['responsible_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


        <div class="clearfix"></div>
        <div class="col-sm-12 mb-2 col-md-4">
            <div class="form-group">
                <?php
                $finished_product_old = old('finished_product');
                ?>
                <label><?php echo app('translator')->get('index.finished_product'); ?> <span class="required_star">*</span></label>
                <select class="form-control <?php $__errorArgs = ['finish_product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2"
                    id="finished_product" name="finished_product">
                    <option value=""><?php echo app('translator')->get('index.select'); ?></option>
                    <?php $__currentLoopData = $finished_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($value->id); ?>|<?php echo e($value->name); ?>|<?php echo e($value->code); ?>|<?php echo e(lastProductionCost($value->id)); ?>|<?php echo e(getPurchaseSaleUnitById($value->unit)); ?>|<?php echo e($setting->currency); ?>|<?php echo e($value->current_total_stock); ?>|<?php echo e($value->stock_method); ?>">
                            <?php echo e($value->name); ?>(<?php echo e($value->code); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['finish_product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive" id="purchase_cart">
                <table class="table">
                    <thead>
                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                        <th class="w-40"><?php echo app('translator')->get('index.raw_materials'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                        <th class="w-20"><?php echo app('translator')->get('index.quantity_amount'); ?></th>
                        <th class="w-20"><?php echo app('translator')->get('index.loss_amount'); ?> 
                        </th>
                        <th class="w-5 ir_txt_center"><?php echo app('translator')->get('index.actions'); ?></th>
                    </thead>
                    <tbody class="add_tr">
                        <?php if(isset($product_wast_items) && $product_wast_items): ?>
                            <?php $__currentLoopData = $product_wast_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="rowCount" data-id="<?php echo e($value->finish_product_id); ?>">
                                    <td class="width_1_p text-start">
                                        <p class="set_sn"></p>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?php echo e($value->finish_product_id); ?>"
                                            name="product_id[]">
                                        <input type="hidden" value="<?php echo e($value->manufacture_id); ?>"
                                            name="manufacture_id[]">
                                        <span class="name_id_<?php echo e($value->finish_product_id); ?>">
                                            <?php echo e(getFinishProduct($value->finish_product_id)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <input type="hidden" tabindex="5" name="unit_price[]"
                                            onfocus="this.select();"
                                            class="check_required form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk input_aligning unit_price_c cal_row"
                                            placeholder="Unit Price" value="<?php echo e($value->last_purchase_price); ?>"
                                            id="unit_price_1">
                                        <div class="input-group">
                                            <input type="number" data-countid="1" tabindex="51" id="qty_1"
                                                name="quantity_amount[]" onfocus="this.select();"
                                                class="check_required form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> integerchk aligning qty_c cal_row"
                                                value="<?php echo e($value->fp_waste_amount); ?>"
                                                data-stock="<?php echo e($value->fp_waste_amount + getCurrentProductStock($value->finish_product_id)); ?>"
                                                data-unit="<?php echo e(getPurchaseUnitByProductID($value->finish_product_id)); ?>"
                                                placeholder="Qty/Amount">

                                            <span
                                                class="input-group-text"><?php echo e(getPurchaseUnitByProductID($value->finish_product_id)); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" onfocus="select();" id="total_1" name="total[]"
                                                class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> input_aligning total_c cal_total"
                                                value="<?php echo e($value->loss_amount); ?>" placeholder="Total">
                                            <span class="input-group-text"><?php echo e($setting->currency); ?></span>
                                        </div>
                                    </td>
                                    <td class="ir_txt_center"><a class="btn btn-xs del_row dlt_button"><iconify-icon
                                                icon="solar:trash-bin-minimalistic-broken"></iconify-icon></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="clearfix"></div><br>

    <div class="row">
        <div class="col-md-4">
            <label><?php echo app('translator')->get('index.note'); ?></label>
            <textarea name="note" id="note" class="form-control <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Note"
                rows="3"><?php echo e(isset($obj->note) ? $obj->note : old('note')); ?></textarea>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-3 mrl-84">
            <label class="custom_label"><?php echo app('translator')->get('index.total_loss'); ?> <span class="required_star">*</span></label>
            <div class="input-group w-90">
                <input type="text" name="grand_total" id="grand_total"
                    class="form-control <?php $__errorArgs = ['grand_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" readonly placeholder="G.Total">
                <span class="input-group-text">
                    <?php echo e($setting->currency); ?>

                </span>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="row mt-2">
        <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
            <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                    icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.submit'); ?></button>
            <a class="btn bg-second-btn" href="<?php echo e(route('product-wastes.index')); ?>"><iconify-icon
                    icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
        </div>
    </div>
</div>
<?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\product_waste\_form.blade.php ENDPATH**/ ?>