
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
                    <?php if(routePermission('sale.print-invoice')): ?>
                        <a href="javascript:void();" target="_blank" class="btn bg-second-btn print_invoice"
                            data-id="<?php echo e($obj->id); ?>"><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.print'); ?></a>
                    <?php endif; ?>
                    <?php if(routePermission('sale.download-invoice')): ?>
                        <a href="<?php echo e(route('sales.download_invoice', encrypt_decrypt($obj->id, 'encrypt'))); ?>"
                            target="_blank" class="btn bg-second-btn print_btn"><iconify-icon
                                icon="solar:cloud-download-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.download'); ?></a>
                    <?php endif; ?>
                    <?php if(routePermission('sale.index')): ?>
                        <a class="btn bg-second-btn" href="<?php echo e(route('sales.index')); ?>"><iconify-icon
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
                                        <p class="pb-7 rgb-71"><?php echo e(safe(getCompanyInfo()->address)); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.email'); ?> : <?php echo e(safe(getCompanyInfo()->email)); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.phone'); ?> : <?php echo e(safe(getCompanyInfo()->phone)); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo app('translator')->get('index.website'); ?> : <?php echo e(safe(getCompanyInfo()->web_site)); ?>

                                        </p>
                                    </td>
                                    <td class="w-50 text-right">
                                        <img src="<?php echo getBaseURL() .
                                            (isset(getWhiteLabelInfo()->logo) ? 'uploads/white_label/' . getWhiteLabelInfo()->logo : 'images/logo.png'); ?>" alt="site-logo">
                                    </td>
                                </tr>
                            </table>
                            <div class="text-center pt-10 pb-10">
                                <h2 class="color-000000 pt-20 pb-20"><?php echo app('translator')->get('index.sales_invoice'); ?></h2>
                            </div>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h4 class="pb-7"><?php echo app('translator')->get('index.customer_info'); ?>:</h4>
                                        <p class="pb-7"><?php echo e($obj->customer->name); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($obj->customer->address); ?></p>
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
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.status'); ?>:</span>
                                            <?php echo e($obj->status); ?>

                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <table class="w-100 mt-20">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-30 text-start"><?php echo app('translator')->get('index.product'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                        <th class="w-15 text-center"><?php echo app('translator')->get('index.unit_price'); ?></th>
                                        <th class="w-15 text-center"><?php echo app('translator')->get('index.quantity'); ?></th>
                                        <th class="w-20 text-right pr-5"><?php echo app('translator')->get('index.total'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($sale_details) && $sale_details): ?>
                                        <?php $__currentLoopData = $sale_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $productInfo = getFinishedProductInfo($value->product_id);
                                            $manufactureInfo = $value->manufacture_id != null ? getManufactureInfo($value->manufacture_id) : null;
                                            ?>
                                            <tr class="rowCount" data-id="<?php echo e($value->product_id); ?>">
                                                <td class="width_1_p">
                                                    <p class="set_sn"><?php echo e($key + 1); ?></p>
                                                </td>
                                                <td class="text-start">
                                                    <?php echo e($productInfo->name); ?>(<?php echo e($productInfo->code); ?>)
                                                    <?php if(
                                                        $manufactureInfo &&
                                                            $manufactureInfo->expiry_days !== null &&
                                                            $manufactureInfo->complete_date !== null &&
                                                            $manufactureInfo->expiry_days !== 0): ?>
                                                        <br><small>Expiry Date:
                                                            <?php echo e(getDateFormat(expireDate($manufactureInfo->complete_date, $manufactureInfo->expiry_days))); ?></small>
                                                    <?php endif; ?>
                                                    <?php if($manufactureInfo && $manufactureInfo->batch_no !== null && $manufactureInfo->batch_no !== ''): ?>
                                                        <br><small>Batch Number: <?php echo e($manufactureInfo->batch_no); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo e(getAmtCustom($value->unit_price)); ?>

                                                </td>
                                                <td class="text-center"><?php echo e($value->product_quantity); ?>

                                                    <?php echo e(getRMUnitById($productInfo->unit)); ?>

                                                </td>
                                                <td class="text-right pr-10"><?php echo e(getAmtCustom($value->total_amount)); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <table>
                                <tr>
                                    <td valign="top" class="w-50">
                                        <div class="pt-20">
                                            <h4 class="d-block pb-10"><?php echo app('translator')->get('index.note'); ?></h4>
                                            <div class="">
                                                <p class="h-180 color-black">
                                                    <?php echo e($obj->note); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="w-50">
                                        <table>
                                            <tr>
                                                <td class="w-50 pr-0">
                                                    <p class=""><?php echo app('translator')->get('index.subtotal'); ?></p>
                                                </td>
                                                <td class="w-50 pr-0 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->subtotal)); ?> </p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50 pr-0">
                                                    <p class=""><?php echo app('translator')->get('index.other'); ?></p>
                                                </td>
                                                <td class="w-50 pr-0 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->other)); ?> </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class=""><?php echo app('translator')->get('index.discount'); ?></p>
                                                </td>
                                                <td class="w-50 pr-0 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->discount)); ?> </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="mt-10 mb-10">
                                            <tr>
                                                <td class="w-50 pr-0 border-top-dotted-gray border-bottom-dotted-gray">
                                                    <p class=""><?php echo app('translator')->get('index.grand_total'); ?> :</p>
                                                </td>
                                                <td class="w-50 pr-0 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->grand_total)); ?> </p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50 pr-0">
                                                    <p class=""><?php echo app('translator')->get('index.paid'); ?></p>
                                                </td>
                                                <td class="w-50 pr-0 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->paid)); ?> </p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50 pr-0">
                                                    <p class=""><?php echo app('translator')->get('index.due'); ?></p>
                                                </td>
                                                <td class="w-50 pr-0 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->due)); ?> </p>
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
                    </div>
                </div>
            </div>

        </section>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo $baseURL . 'frequent_changing/js/sales.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\sales\viewSalesDetails.blade.php ENDPATH**/ ?>