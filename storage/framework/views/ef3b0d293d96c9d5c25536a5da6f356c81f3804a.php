<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($obj->reference_no); ?></title>
    <link rel="stylesheet" href="<?php echo e(getBaseURL()); ?>frequent_changing/css/pdf_common.css">
</head>

<body>
    <div class="m-auto b-r-5 p-30">
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
            <h2 class="color-000000 pt-20 pb-20"><?php echo app('translator')->get('index.challan'); ?></h2>
        </div>
        <table>
            <tr>
                <td class="w-50">
                    <h4 class="pb-7"><?php echo app('translator')->get('index.bill_to'); ?>:</h4>
                    <p class="pb-7 rgb-71 arabic"><?php echo e($obj->customer->name); ?></p>
                    <p class="pb-7 rgb-71 arabic"><?php echo e($obj->customer->address); ?></p>
                    <p class="pb-7 rgb-71"><?php echo e($obj->customer->phone); ?></p>
                </td>
                <td class="w-50 text-right">
                    <h4 class="pb-7"><?php echo app('translator')->get('index.sale_info'); ?>:</h4>
                    <p class="pb-7">
                        <span class=""><?php echo app('translator')->get('index.invoice_no'); ?>:</span>
                        <?php echo e($obj->reference_no); ?>

                    </p>
                    <p class="pb-7 rgb-71">
                        <span class=""><?php echo app('translator')->get('index.sale_date'); ?>:</span>
                        <?php echo e(getDateFormat($obj->sale_date)); ?>

                    </p>
                </td>
            </tr>
        </table>

        <table class="w-100 mt-20">
            <thead class="b-r-3 bg-color-000000">
                <tr>
                    <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                    <th class="w-20 text-start"><?php echo app('translator')->get('index.product'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                    <th class="w-15"><?php echo app('translator')->get('index.quantity'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($sale_details) && $sale_details): ?>
                    <?php $__currentLoopData = $sale_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $i = 1;
                        $productInfo = getFinishedProductInfo($value->product_id);
                        ?>
                        <tr class="rowCount" data-id="<?php echo e($value->product_id); ?>">
                            <td class="width_1_p">
                                <p class="set_sn"><?php echo e($i++); ?></p>
                            </td>
                            <td><?php echo e($productInfo->name); ?>(<?php echo e($productInfo->code); ?>)</td>
                            <td class="text-center"><?php echo e($value->product_quantity); ?>

                                <?php echo e(getRMUnitById($productInfo->unit)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    </div>
    <?php
        $baseURL = getBaseURL();
        $setting = getSettingsInfo();
        $base_color = '#6ab04c';
        if (isset($setting->base_color) && $setting->base_color) {
            $base_color = $setting->base_color;
        }
    ?>
    <script src="<?php echo e($baseURL .('assets/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e($baseURL . ('frequent_changing/js/onload_print.js')); ?>"></script>
</body>

</html>
<?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\sales\challan.blade.php ENDPATH**/ ?>