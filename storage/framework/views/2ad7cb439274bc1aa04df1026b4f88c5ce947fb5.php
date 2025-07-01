
<?php $__env->startSection('content'); ?>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
    ?>
    <link rel="stylesheet" href="<?php echo e(getBaseURL() . 'frequent_changing/css/pdf_common.css'); ?>">    
    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header"><?php echo app('translator')->get('index.purchase_details'); ?></h2>
                </div>
                <div class="col-md-6">
                    <?php if(routePermission('purchase.print')): ?>
                        <a href="javascript:void();" target="_blank" class="btn bg-second-btn print_invoice"
                            data-id="<?php echo e($obj->id); ?>"><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.print'); ?></a>
                    <?php endif; ?>
                    <?php if(routePermission('purchase.download')): ?>
                        <a href="<?php echo e(route('download_purchase_invoice', encrypt_decrypt($obj->id, 'encrypt'))); ?>"
                            target="_blank" class="btn bg-second-btn print_btn"><iconify-icon
                                icon="solar:cloud-download-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.download'); ?></a>
                    <?php endif; ?>
                    <?php if(routePermission('purchase.index')): ?>
                        <a class="btn bg-second-btn" href="<?php echo e(route('rawmaterialpurchases.index')); ?>"><iconify-icon
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
                                <h2 class="color-000000 pt-20 pb-20"><?php echo app('translator')->get('index.purchase_invoice'); ?></h2>
                            </div>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h4 class="pb-7"><?php echo app('translator')->get('index.supplier_info'); ?>:</h4>
                                        <p class="pb-7"><?php echo e($suppliers[0]->name); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($suppliers[0]->contact_person); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($suppliers[0]->phone); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($suppliers[0]->email); ?></p>
                                        <p class="pb-7 rgb-71"><?php echo e($suppliers[0]->address); ?></p>
                                    </td>
                                    <td class="w-50 text-right">
                                        <h4 class="pb-7"><?php echo app('translator')->get('index.purchase_info'); ?>:</h4>
                                        <p class="pb-7">
                                            <span class="f-w-600"><?php echo app('translator')->get('index.invoice'); ?>:</span>
                                            <?php echo e(isset($obj->invoice_no) && $obj->invoice_no != null ? $obj->invoice_no : $obj->reference_no); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600"><?php echo app('translator')->get('index.date'); ?>:</span>
                                            <?php echo e(getDateFormat($obj->date)); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600"><?php echo app('translator')->get('index.status'); ?>:</span>
                                            <span class="status-draft"><?php echo e($obj->status); ?></span>
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600"><?php echo app('translator')->get('index.type'); ?>:</span>
                                            <span
                                                class="status-draft"><?php echo e($obj->type == 'purchase_order' ? 'Purchase Order' : 'Purchase'); ?></span>
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600"><?php echo app('translator')->get('index.payment_status'); ?>:</span>
                                            <span class="status-draft"><?php echo e(paymentStatus($obj->due, $obj->paid)); ?></span>
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <table class="w-100 mt-20">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-30 text-start"><?php echo app('translator')->get('index.raw_material'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                        <th class="w-15 text-center"><?php echo app('translator')->get('index.unit_price'); ?></th>
                                        <th class="w-15 text-center"><?php echo app('translator')->get('index.quantity'); ?></th>
                                        <th class="w-20 text-right pr-5"><?php echo app('translator')->get('index.total'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($pruchse_rmaterials) && $pruchse_rmaterials): ?>
                                        <?php $i = 1; ?>
                                        <?php $__currentLoopData = $pruchse_rmaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="rowCount" data-id="<?php echo e($value->finishProduct_id); ?>">

                                                <td class="width_1_p">
                                                    <p class="set_sn"><?php echo e($i++); ?></p>
                                                </td>
                                                <td class=""><?php echo e(getRMName($value->rmaterials_id)); ?></td>
                                                <td class="text-center"><?php echo e($value->unit_price); ?> <?php echo e($setting->currency); ?>

                                                </td>
                                                <td class="text-center"><?php echo e($value->quantity_amount); ?>

                                                    <?php echo e(getUnitByRMID($value->rmaterials_id)); ?>

                                                </td>
                                                <td class="text-right pr-10"><?php echo e($value->total); ?> <?php echo e($setting->currency); ?>

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
                                                <td class="w-50">
                                                    <p class="f-w-600"><?php echo app('translator')->get('index.subtotal'); ?></p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(safe_integer($obj->subtotal)); ?> <?php echo e($setting->currency); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="f-w-600"><?php echo app('translator')->get('index.other'); ?></p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(safe_integer($obj->other)); ?> <?php echo e($setting->currency); ?></p>
                                                </td>
                                            </tr>
                                        </table>

                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="f-w-600"><?php echo app('translator')->get('index.discount'); ?></p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(safe_integer($obj->discount)); ?> <?php echo e($setting->currency); ?></p>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="mt-10 mb-10">
                                            <tr>
                                                <td class="w-50 border-top-dotted-gray border-bottom-dotted-gray">
                                                    <p class="f-w-600"><?php echo app('translator')->get('index.grand_total'); ?> :</p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(safe_integer($obj->grand_total)); ?> <?php echo e($setting->currency); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="f-w-600"><?php echo app('translator')->get('index.paid'); ?></p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(safe_integer($obj->paid)); ?> <?php echo e($setting->currency); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="f-w-600"><?php echo app('translator')->get('index.account'); ?></p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(getAccountName($obj->account)); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="f-w-600"><?php echo app('translator')->get('index.due'); ?></p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(safe_integer($obj->due)); ?> <?php echo e($setting->currency); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php if($obj->converted_currency_id != null): ?>
                                            <table>
                                                <tr>
                                                    <td class="w-50">
                                                        <p class="f-w-600">Paid in <?php echo e(singleCurrency($obj->converted_currency_id)->symbol); ?> <?php echo e(number_format($obj->converted_amount, 2)); ?> Where 1<?php echo e($setting->currency); ?> = <?php echo e(singleCurrency($obj->converted_currency_id)->conversion_rate); ?> <?php echo e(singleCurrency($obj->converted_currency_id)->symbol); ?></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php endif; ?>
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
    <?php
    $baseURL = getBaseURL();
    ?>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/addRMPurchase.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/supplier.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/js/purchase.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\purchase\viewDetails.blade.php ENDPATH**/ ?>