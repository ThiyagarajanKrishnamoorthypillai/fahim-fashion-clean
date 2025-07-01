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
                    <h2 class="top-left-header"><?php echo app('translator')->get('index.customer_payment_invoice'); ?></h2>
                </div>
                <div class="col-md-6">
                        <a href="javascript:void();" target="_blank" class="btn bg-second-btn print_invoice"
                            data-id="<?php echo e($obj->id); ?>"><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.print'); ?></a>
                        <a class="btn bg-second-btn" href="<?php echo e(route('customer-payment.index')); ?>"><iconify-icon
                                icon="solar:round-arrow-left-broken"></iconify-icon><?php echo app('translator')->get('index.back'); ?></a>
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
                                <h2 class="color-000000 pt-20 pb-20"><?php echo app('translator')->get('index.customer_payment_invoice'); ?></h2>
                            </div>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h4 class="pb-7"><?php echo app('translator')->get('index.customer_info'); ?>:</h4>
                                        <p class="pb-7 arabic"><?php echo e($obj->customerName->name); ?></p>
                                        <p class="pb-7 rgb-71 arabic"><?php echo e($obj->customerName->address); ?></p>
                                        <p class="pb-7 rgb-71 arabic"><?php echo e($obj->customerName->phone); ?></p>
                                    </td>
                                    <td class="w-50 text-right">
                                        <h4 class="pb-7"><?php echo app('translator')->get('index.customer_payment_invoice'); ?>:</h4>
                                        <p class="pb-7">
                                            <span class=""><?php echo app('translator')->get('index.invoice_no'); ?>:</span>
                                            <?php echo e($obj->reference_no); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.payment_date'); ?>:</span>
                                            <?php echo e(getDateFormat($obj->only_date)); ?>

                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <table class="w-100 mt-20">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-30 text-start"><?php echo app('translator')->get('index.customer'); ?></th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.amount'); ?></th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.date'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    <tr class="rowCount" data-id="<?php echo e($obj->id); ?>">
                                        <td class="width_1_p">
                                            <p class="set_sn"><?php echo e($i++); ?></p>
                                        </td>
                                        <td class="text-start arabic"><?php echo e(@$obj->customerName->name); ?></td>
                                        <td class="text-start"><?php echo e(getAmtCustom($obj->amount)); ?>

                                        </td>
                                        <td class="text-start">
                                            <?php echo e(getDateFormat($obj->only_date)); ?>

                                        </td>
                                    </tr>
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
                                                    <p class="f-w-600">Amount Pay</p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(getAmtCustom($obj->amount)); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="f-w-600">Amount Due</p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(getAmtCustom(getCustomerDue($obj->supplier))); ?></p>
                                                </td>
                                            </tr>
                                        </table>                                        
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="f-w-600">Amount Enclosed</p>
                                                </td>
                                                <td class="w-50 text-right pr-0">
                                                    <p><?php echo e(getAmtCustom(getCustomerDue($obj->supplier))); ?></p>
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
    <?php
    $baseURL = getBaseURL();
    ?>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/addRMPurchase.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/supplier.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/js/customer_payment.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\customer_payment\invoice.blade.php ENDPATH**/ ?>