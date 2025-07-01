<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo app('translator')->get('index.demand_forecasting_by_order'); ?></title>
    <link rel="stylesheet" href="<?php echo e(getBaseURL()); ?>frequent_changing/css/pdf_common.css">
</head>

<body>
    <div class="m-auto b-r-5 p-30">
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <table>
                <tr>
                    <td class="w-50">
                        <h3 class="pb-7"><?php echo e(getCompanyInfo()->company_name); ?></h3>
                        <p class="pb-7 rgb-71"><?php echo e(safe(getCompanyInfo()->address)); ?></p>
                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.email'); ?> : <?php echo e(safe(getCompanyInfo()->email)); ?></p>
                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.phone'); ?> : <?php echo e(safe(getCompanyInfo()->phone)); ?></p>
                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.website'); ?> : <?php echo e(safe(getCompanyInfo()->website)); ?></p>
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

            <table>
                <tr>
                    <td class="w-50">
                        <h4 class="pb-7"><?php echo app('translator')->get('index.customer_info'); ?>:</h4>
                        <p class="pb-7 rgb-71 arabic"><?php echo e($order->customer->name); ?></p>
                        <p class="pb-7 rgb-71 arabic"><?php echo e($order->customer->address); ?></p>
                        <p class="pb-7 rgb-71"><?php echo e($order->customer->phone); ?></p>
                    </td>
                    <td class="w-50 text-right">
                        <h4 class="pb-7"><?php echo app('translator')->get('index.sale_info'); ?>:</h4>
                        <p class="pb-7">
                            <span class=""><?php echo app('translator')->get('index.invoice_no'); ?>:</span>
                            <?php echo e($order->reference_no); ?>

                        </p>
                        <p class="pb-7 rgb-71">
                            <span class=""><?php echo app('translator')->get('index.sale_date'); ?>:</span>
                            <?php echo e(getDateFormat($order->sale_date)); ?>

                        </p>
                        <p class="pb-7 rgb-71">
                            <span class=""><?php echo app('translator')->get('index.status'); ?>:</span>
                            <?php echo e($order->status); ?>

                        </p>
                    </td>
                </tr>
            </table>

            <h4 class="mt-20"><?php echo app('translator')->get('index.ordered_product'); ?>:</h4>
            <table class="w-100 mt-10">
                <thead class="b-r-3 bg-color-000000">
                    <tr>
                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                        <th class="w-30 text-start"><?php echo app('translator')->get('index.product'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                        <th class="w-15 text-start"><?php echo app('translator')->get('index.quantity'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($order->details) && count($order->details) > 0): ?>
                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $i = 1;
                            $productInfo = getFinishedProductInfo($value->product_id);
                            $need_to_manufacture = (int)$productInfo->current_total_stock - (int)$value->quantity;
                            ?>
                            <tr class="rowCount" data-id="<?php echo e($value->product_id); ?>">
                                <td class="width_1_p">
                                    <p class="set_sn"><?php echo e($i++); ?></p>
                                </td>
                                <td class="text-start arabic"><?php echo e($productInfo->name); ?>(<?php echo e($productInfo->code); ?>)</td>                               
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
                        <th class="w-30 text-start"><?php echo app('translator')->get('index.product'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                        <th class="w-15 text-start"><?php echo app('translator')->get('index.available_quantity'); ?></th>
                        <th class="w-15 text-start"><?php echo app('translator')->get('index.required_quantity'); ?></th>
                        <th class="w-20 text-right pr-5"><?php echo app('translator')->get('index.need_to_manufacture'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($order->details) && count($order->details) > 0): ?>
                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $i = 1;
                            $productInfo = getFinishedProductInfo($value->product_id);
                            $need_to_manufacture = (int)$productInfo->current_total_stock - (int)$value->quantity;
                            ?>
                            <tr class="rowCount" data-id="<?php echo e($value->product_id); ?>">
                                <td class="width_1_p">
                                    <p class="set_sn"><?php echo e($i++); ?></p>
                                </td>
                                <td class="text-start arabic"><?php echo e($productInfo->name); ?>(<?php echo e($productInfo->code); ?>)</td>

                                <td class="text-start"><?php echo e($productInfo->current_total_stock); ?>

                                    <?php echo e(getRMUnitById($productInfo->unit)); ?>

                                </td>
                                <td class="text-start"><?php echo e($value->quantity); ?>

                                    <?php echo e(getRMUnitById($productInfo->unit)); ?>

                                </td>
                                <td class="text-right pr-10">
                                    <?php echo e($need_to_manufacture > 0 ? 0 : abs($need_to_manufacture)); ?>

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
                        <th class="w-30 text-start"><?php echo app('translator')->get('index.raw_material'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                        <th class="w-15 text-start"><?php echo app('translator')->get('index.available_quantity'); ?></th>
                        <th class="w-15 text-start"><?php echo app('translator')->get('index.required_quantity'); ?></th>
                        <th class="w-20 text-right pr-5"><?php echo app('translator')->get('index.need_to_purchase'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($order->details) && count($order->details) > 0): ?>
                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $i = 1;
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
                                        <td class="text-start arabic">
                                            <?php echo e($minfo->name); ?>(<?php echo e($minfo->code); ?>)</td>

                                        <td class="text-start"><?php echo e($minfo->current_stock); ?>

                                            <?php echo e(getRMUnitById($minfo->unit)); ?>

                                        </td>
                                        <td class="text-start"><?php echo e($required_quantity); ?>

                                            <?php echo e(getRMUnitById($minfo->unit)); ?>

                                        </td>
                                        <td class="text-right pr-10">
                                            <?php echo e($need_to_purchase > 0 ? 0 : abs($need_to_purchase)); ?>

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



            <table class="mt-50">
                <tr>
                    <td class="w-50">
                    </td>
                    <td class="w-50 text-right">
                        <p class="rgb-71 d-inline border-top-e4e5ea pt-10"><?php echo app('translator')->get('index.authorized_signature'); ?></p>
                    </td>
                </tr>
            </table>
            <?php if(!$loop->last): ?>
                <div class="page-break"></div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
    ?>
    <script src="<?php echo e($baseURL . 'assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo e($baseURL . 'frequent_changing/js/onload_print.js'); ?>"></script>

</body>

</html>
<?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\forecasting\order-print.blade.php ENDPATH**/ ?>