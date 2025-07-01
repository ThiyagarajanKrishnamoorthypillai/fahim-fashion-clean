
<?php $__env->startSection('script_top'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php
    $setting = getSettingsInfo();
    $tax_setting = getTaxInfo();
    $baseURL = getBaseURL();
    ?>
    <link rel="stylesheet" href="<?php echo e(getBaseURL()); ?>frequent_changing/css/pdf_common.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Optional theme -->

    <section class="main-content-wrapper bg-main">
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header"><?php echo e(isset($title) && $title ? $title : ''); ?></h2>
                </div>
                <div class="col-md-6">
                    <?php if(routePermission('order.print-invoice')): ?>
                        <a href="javascript:void();" target="_blank" class="btn bg-second-btn print_invoice"
                            ><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.print'); ?></a>
                    <?php endif; ?>
                    <?php if(routePermission('order.download-invoice')): ?>
                        <a href="<?php echo e(route('forecasting.order.download')); ?>"
                            target="_blank" class="btn bg-second-btn print_btn"><iconify-icon
                                icon="solar:cloud-download-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.download'); ?></a>
                    <?php endif; ?>
                    <?php if(routePermission('order.index')): ?>
                        <a class="btn bg-second-btn" href="<?php echo e(route('forecasting.order')); ?>"><iconify-icon
                                icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="col-md-12">
                <div class="card" id="dash_0">
                    <div class="card-body p30">
                        <div class="m-auto b-r-5">
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h3 class="pb-7"><?php echo e(getCompanyInfo()->company_name); ?></h3>
                                        <p class="pb-7 rgb-71"><?php echo e(getCompanyInfo()->address); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.email'); ?> : <?php echo e(getCompanyInfo()->email); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.phone'); ?> : <?php echo e(getCompanyInfo()->phone); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.website'); ?> : <?php echo e(getCompanyInfo()->web_site); ?></p>
                                    </td>
                                    <td class="w-50 text-right">
                                        <img src="<?php echo getBaseURL() .
                                            (isset(getWhiteLabelInfo()->logo) ? 'uploads/white_label/' . getWhiteLabelInfo()->logo : 'images/logo.png'); ?>" alt="site-logo">
                                    </td>
                                </tr>
                            </table>
                            <div class="text-center pt-10 pb-10">
                                <h2 class="color-000000 pt-20 pb-20"><?php echo app('translator')->get('index.demand_forecasting_by_order'); ?></h2>
                            </div>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
                            <table class="mt-20">
                                <tr>
                                    <td class="w-50 text-left">
                                        <h4 class="pb-7"><?php echo app('translator')->get('index.order_info'); ?>:</h4>
                                        <p class="pb-7">
                                            <span class=""><?php echo app('translator')->get('index.reference_no'); ?>:</span>
                                            <?php echo e($order->reference_no); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.delivery_date'); ?>:</span>
                                            <?php echo e(getDateFormat($order->date)); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.type'); ?>:</span>
                                            <?php echo e($order->order_type); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.delivery_address'); ?>:</span>
                                            <?php echo e($order->delivery_address); ?>

                                        </p>
                                    </td>
                                    <td class="w-50 text-right">
                                        <h4 class="pb-7"><?php echo app('translator')->get('index.customer_info'); ?>:</h4>
                                        <p class="pb-7"><?php echo e($order->customer->name); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($order->customer->address); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($order->customer->phone); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($order->customer->email); ?></p>
                                    </td>                                    
                                </tr>
                            </table>

                            
                            <h4><?php echo app('translator')->get('index.ordered_product'); ?>:</h4>
                            <table class="w-100 mt-10">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-25 text-start"><?php echo app('translator')->get('index.product'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.quantity'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($order->details) && count($order->details) > 0): ?>
                                        <?php ($i = 1); ?>
                                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $productInfo = getFinishedProductInfo($value->product_id);
                                            $need_to_manufacture = (int)$productInfo->current_total_stock - (int)$value->quantity;
                                            ?>
                                            <tr class="rowCount" data-id="<?php echo e($value->product_id); ?>">
                                                <td class="width_1_p">
                                                    <p class="set_sn"><?php echo e($i++); ?></p>
                                                </td>
                                                <td class="text-start"><?php echo e($productInfo->name); ?>(<?php echo e($productInfo->code); ?>)
                                                </td>
                                                <td class="text-start"><?php echo e($value->quantity); ?>

                                                    <?php echo e(getRMUnitById($productInfo->unit)); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center"><?php echo app('translator')->get('index.no_data_available'); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>


                            
                            <h4 class="mt-20"><?php echo app('translator')->get('index.product_forecasting'); ?>:</h4>
                            <table class="w-100 mt-10">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-25 text-start"><?php echo app('translator')->get('index.product'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.available_quantity'); ?></th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.required_quantity'); ?></th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.need_to_manufacture'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($order->details) && count($order->details) > 0): ?>
                                        <?php ($i = 1); ?>
                                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $productInfo = getFinishedProductInfo($value->product_id);
                                            $need_to_manufacture = (int)$productInfo->current_total_stock - (int)$value->quantity;
                                            ?>
                                            <tr class="rowCount" data-id="<?php echo e($value->product_id); ?>">
                                                <td class="width_1_p">
                                                    <p class="set_sn"><?php echo e($i++); ?></p>
                                                </td>
                                                <td class="text-start"><?php echo e($productInfo->name); ?>(<?php echo e($productInfo->code); ?>)
                                                </td>
                                                <td class="text-start"><?php echo e($productInfo->current_total_stock); ?>

                                                    <?php echo e(getRMUnitById($productInfo->unit)); ?>

                                                </td>
                                                <td class="text-start"><?php echo e($value->quantity); ?>

                                                    <?php echo e(getRMUnitById($productInfo->unit)); ?>

                                                </td>
                                                <td class="text-start"><?php echo e($need_to_manufacture > 0 ? 0 : abs($need_to_manufacture)); ?>

                                                    <?php echo e(getRMUnitById($productInfo->unit)); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center"><?php echo app('translator')->get('index.no_data_available'); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            
                            <h4 class="mt-20"><?php echo app('translator')->get('index.raw_material_forecasting'); ?>:</h4>
                            <table class="w-100 mt-10">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-25 text-start"><?php echo app('translator')->get('index.raw_material'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.available_quantity'); ?></th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.required_quantity'); ?></th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.need_to_purchase'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($order->details) && count($order->details) > 0): ?>
                                        <?php ($i = 1); ?>
                                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                            
                                            <?php
                                            $rawMaterial = getProductRawMaterialByProductId($value->product_id);
                                            ?>
                                            
                                            <?php if(count($rawMaterial) > 0): ?>
                                                <?php $__currentLoopData = $rawMaterial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                    $minfo = getRawMaterialInfoById($rm->rmaterials_id);
                                                    $required_quantity = $rm->consumption * $value->quantity;
                                                    $need_to_purchase = (int)$minfo->current_stock - (int)$required_quantity;
                                                    ?>
                                                    <tr class="rowCount" data-id="<?php echo e($rm->id); ?>">
                                                        <td class="width_1_p">
                                                            <p class="set_sn"><?php echo e($i++); ?></p>
                                                        </td>
                                                        <td class="text-start"><?php echo e($minfo->name); ?>(<?php echo e($minfo->code); ?>)
                                                        </td>
                                                        <td class="text-start"><?php echo e(number_format($minfo->current_stock, 2)); ?>

                                                            <?php echo e(getRMUnitById($minfo->unit)); ?>

                                                        </td>
                                                        <td class="text-start"><?php echo e($required_quantity); ?>

                                                            <?php echo e(getRMUnitById($minfo->unit)); ?>

                                                        </td>
                                                        <td class="text-start"><?php echo e($need_to_purchase > 0 ? 0 : abs($need_to_purchase)); ?>

                                                            <?php echo e(getRMUnitById($minfo->unit)); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center"><?php echo app('translator')->get('index.no_data_available'); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <table class="mt-50">
                                <tr>
                                    <td class="w-50">
                                    </td>
                                    <td class="w-50 text-right">
                                        <p class="rgb-71 d-inline border-top-e4e5ea pt-10"><?php echo app('translator')->get('index.authorized_signature'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo $baseURL . 'frequent_changing/js/order_forecast.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\forecasting\order-view.blade.php ENDPATH**/ ?>