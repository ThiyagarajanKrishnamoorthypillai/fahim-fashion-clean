<?php
$setting = getSettingsInfo();
$tax_setting = getTaxInfo();
$baseURL = getBaseURL();
?>
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
            <h2 class="color-000000 pt-20 pb-20"><?php echo app('translator')->get('index.order_details'); ?></h2>
        </div>
        <table>
            <tr>
                <td class="w-50">
                    <h4 class="pb-7"><?php echo app('translator')->get('index.customer_info'); ?>:</h4>
                    <p class="pb-7"><?php echo e($obj->customer->name); ?></p>
                    <p class="pb-7 rgb-71"><?php echo e($obj->customer->address); ?></p>
                    <p class="pb-7 rgb-71"><?php echo e($obj->customer->phone); ?></p>
                    <p class="pb-7 rgb-71"><?php echo e($obj->customer->email); ?></p>
                </td>
                <td class="w-50 text-right">
                    <h4 class="pb-7"><?php echo app('translator')->get('index.order_info'); ?>:</h4>
                    <p class="pb-7">
                        <span class=""><?php echo app('translator')->get('index.reference_no'); ?>:</span>
                        <?php echo e($obj->reference_no); ?>

                    </p>
                    <p class="pb-7 rgb-71">
                        <span class=""><?php echo app('translator')->get('index.delivery_date'); ?>:</span>
                        <?php echo e(getDateFormat($obj->date)); ?>

                    </p>
                    <p class="pb-7 rgb-71">
                        <span class=""><?php echo app('translator')->get('index.type'); ?>:</span>
                        <?php echo e($obj->order_type); ?>

                    </p>
                    <p class="pb-7 rgb-71">
                        <span class=""><?php echo app('translator')->get('index.delivery_address'); ?>:</span>
                        <?php echo e($obj->delivery_address); ?>

                    </p>
                </td>
            </tr>
        </table>

        <table class="w-100 mt-20">
            <thead class="b-r-3 bg-color-000000">
                <tr>
                    <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                    <th class="w-25 text-start"><?php echo app('translator')->get('index.product'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                    <th class="w-15 text-center"><?php echo app('translator')->get('index.unit_price'); ?></th>
                    <th class="w-15 text-center"><?php echo app('translator')->get('index.quantity'); ?></th>
                    <th class="w-15 text-center"><?php echo app('translator')->get('index.subtotal'); ?></th>
                    <th class="w-15 text-center"><?php echo app('translator')->get('index.discount'); ?></th>
                    <th class="w-10 text-right pr-5"><?php echo app('translator')->get('index.total'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($orderDetails) && $orderDetails): ?>
                    <?php ($i = 1); ?>
                    <?php $__currentLoopData = $orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $productInfo = getFinishedProductInfo($value->product_id);
                        ?>
                        <tr class="rowCount" data-id="<?php echo e($value->product_id); ?>">
                            <td class="width_1_p">
                                <p class="set_sn"><?php echo e($i++); ?></p>
                            </td>
                            <td class="text-start"><?php echo e($productInfo->name); ?>(<?php echo e($productInfo->code); ?>)</td>
                            <td class="text-center"><?php echo e(getAmtCustom($value->unit_price)); ?></td>
                            <td class="text-center"><?php echo e($value->quantity); ?>

                                <?php echo e(getRMUnitById($productInfo->unit)); ?>

                            </td>
                            <td class="text-center"><?php echo e(getAmtCustom($value->sub_total)); ?>

                            </td>
                            <td class="text-center"><?php echo e(getAmtCustom($value->discount_percent)); ?>

                            </td>
                            <td class="text-right pr-10"><?php echo e(getAmtCustom($value->total_cost)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>


        <h4 class="mt-20"><?php echo app('translator')->get('index.invoice_quotations'); ?></h4>
        <table class="w-100 mt-10">
            <thead class="b-r-3 bg-color-000000">
                <tr>
                    <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                    <th class="w-15 text-start"><?php echo app('translator')->get('index.type'); ?></th>
                    <th class="w-15"><?php echo app('translator')->get('index.date'); ?></th>
                    <th class="w-15"><?php echo app('translator')->get('index.amount'); ?></th>
                    <th class="w-15"><?php echo app('translator')->get('index.paid'); ?></th>
                    <th class="w-15"><?php echo app('translator')->get('index.due'); ?></th>
                    <th class="w-15 text-right"><?php echo app('translator')->get('index.order_due'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($orderInvoice) && $orderInvoice): ?>
                    <?php
                    $i = 1;
                    ?>
                    <?php $__currentLoopData = $orderInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="rowCount">
                            <td class="width_1_p">
                                <p class="set_sn"><?php echo e($i++); ?></p>
                            </td>
                            <td class="text-start"><?php echo e($value->invoice_type); ?></td>
                            <td class="text-center"><?php echo e(getDateFormat($value->invoice_date)); ?></td>
                            <td class="text-center"><?php echo e(getAmtCustom($value->amount)); ?>

                            </td>
                            <td class="text-center"><?php echo e(getAmtCustom($value->paid_amount)); ?>

                            </td>
                            <td class="text-center"><?php echo e(getAmtCustom($value->due_amount)); ?>

                            </td>
                            <td class="text-right pr-10"><?php echo e(getAmtCustom($value->order_due_amount)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if(isset($orderDeliveries) && count($orderDeliveries) > 0): ?>
            <h4 class="w-100 mt-20"><?php echo app('translator')->get('index.deliveries'); ?></h5>
                <table class="w-100 mt-10">
                    <thead class="b-r-3 bg-color-000000">
                        <tr>
                            <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th class="w-20 text-start"><?php echo app('translator')->get('index.product'); ?></th>
                            <th class="w-15"><?php echo app('translator')->get('index.quantity'); ?></th>
                            <th class="w-15"><?php echo app('translator')->get('index.delivery_date'); ?></th>
                            <th class="w-15"><?php echo app('translator')->get('index.status'); ?></th>
                            <th class="w-15 text-right"><?php echo app('translator')->get('index.note'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ($i = 1); ?>
                        <?php $__currentLoopData = $orderDeliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $productInfo = getFinishedProductInfo($value->product_id);
                            
                            ?>
                            <tr class="rowCount">
                                <td class="width_1_p">
                                    <p class="set_sn"><?php echo e($i++); ?></p>
                                </td>
                                <td class="text-start"><?php echo e(safe($productInfo->name)); ?></td>
                                <td class="text-center"><?php echo e(safe($value->quantity)); ?>

                                    <?php echo e(getRMUnitById($productInfo->unit)); ?></td>
                                <td class="text-center"><?php echo e(getDateFormat($value->delivery_date)); ?></td>
                                <td class="text-center"><?php echo e(safe($value->delivery_status)); ?>

                                </td>
                                <td class="text-right"><?php echo e(safe($value->delivery_note)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
        <?php endif; ?>
        <table>
            <tr>
                <td class="w-30">

                </td>
                <td class="w-50">
                    <table class="mt-10 mb-10">
                        <tr>
                            <td class="w-50 border-top-dotted-gray border-bottom-dotted-gray">
                                <p class=""><?php echo app('translator')->get('index.total_cost'); ?> :</p>
                            </td>
                            <td class="w-50 text-right pr-0">
                                <p><?php echo e(getAmtCustom($obj->total_cost)); ?></p>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="w-50">
                                <p class=""><?php echo app('translator')->get('index.subtotal'); ?></p>
                            </td>
                            <td class="w-50 text-right pr-0">
                                <p><?php echo e(getAmtCustom($obj->total_amount)); ?></p>
                            </td>
                        </tr>
                    </table>   
                    <table>
                        <tr>
                            <td class="w-50">
                                <p class=""><?php echo app('translator')->get('index.profit'); ?></p>
                            </td>
                            <td class="w-50 text-right pr-0">
                                <p><?php echo e(getAmtCustom($obj->total_profit)); ?></p>
                            </td>
                        </tr>
                    </table>                  
                </td>
            </tr>
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
    <script src="<?php echo e($baseURL . ('assets/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e($baseURL . ('frequent_changing/js/onload_print.js')); ?>"></script>
</body>

</html>
<?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\customer_order\invoice.blade.php ENDPATH**/ ?>