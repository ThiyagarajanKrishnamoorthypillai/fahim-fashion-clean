
<?php $__env->startSection('script_top'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php
    $setting = getSettingsInfo();
    $tax_setting = getTaxInfo();
    $baseURL = getBaseURL();
    ?>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo $baseURL . 'assets/bower_components/gantt/css/style.css'; ?>">
    <link rel="stylesheet" href="<?php echo e(getBaseURL()); ?>frequent_changing/css/pdf_common.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Optional theme -->
    <input type="hidden" id="edit_mode" value="<?php echo e(isset($obj) && $obj ? $obj->id : null); ?>">
    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header"><?php echo e(isset($title) && $title ? $title : ''); ?></h2>
                </div>
                <div class="col-md-6">
                    <?php if(routePermission('manufacture.print')): ?>
                        <a href="javascript:void();" target="_blank" class="btn bg-second-btn print_invoice"
                            data-id="<?php echo e($obj->id); ?>"><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            <?php echo app('translator')->get('index.print'); ?></a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('download_manufacture_details', encrypt_decrypt($obj->id, 'encrypt'))); ?>"
                        target="_blank" class="btn bg-second-btn print_btn"><iconify-icon
                            icon="solar:cloud-download-broken"></iconify-icon>
                        <?php echo app('translator')->get('index.download'); ?></a>
                    <?php if(routePermission('manufacture.index')): ?>
                        <a class="btn bg-second-btn" href="<?php echo e(route('productions.index')); ?>"><iconify-icon
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
                                <h2 class="color-000000 pt-20 pb-20"><?php echo app('translator')->get('index.manufacture_details'); ?></h2>
                            </div>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <p class="pb-7">
                                            <span class=""><?php echo app('translator')->get('index.reference_no'); ?>:</span>
                                            <?php echo e($obj->reference_no); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.date'); ?>:</span>
                                            <?php echo e(getDateFormat($obj->created_at)); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.manufacture_type'); ?>:</span>
                                            <?php if($obj->manufacture_type == 'ime'): ?>
                                                Instant Manufacture Entry
                                            <?php elseif($obj->manufacture_type == 'mbs'): ?>
                                                Manufacture by Scheduling
                                            <?php elseif($obj->manufacture_type == 'fco'): ?>
                                                From Customer Order
                                            <?php endif; ?>
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.status'); ?>:</span>
                                            <?php if($obj->manufacture_status == 'draft'): ?>
                                                Draft
                                            <?php elseif($obj->manufacture_status == 'inProgress'): ?>
                                                In Progress
                                            <?php elseif($obj->manufacture_status == 'done'): ?>
                                                Done
                                            <?php endif; ?>
                                        </p>
                                    </td>
                                    <td class="w-50 text-right">
                                        <p class="pb-7">
                                            <span class=""><?php echo app('translator')->get('index.product'); ?>:</span>
                                            <?php echo e(getProductNameById($obj->product_id)); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.quantity'); ?>:</span>
                                            <?php echo e($obj->product_quantity); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.start_date'); ?>:</span>
                                            <?php echo e(getDateFormat($obj->start_date)); ?>

                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class=""><?php echo app('translator')->get('index.complete_date'); ?>:</span>
                                            <?php echo e($obj->complete_date != null ? getDateFormat($obj->complete_date) : 'N/A'); ?>

                                        </p>
                                        <?php if(isset($obj->batch_no) && !empty($obj->batch_no)): ?>
                                            <p class="pb-7 rgb-71">
                                                <span class=""><?php echo app('translator')->get('index.batch_no'); ?>:</span>
                                                <?php echo e($obj->batch_no); ?>

                                            </p>
                                        <?php endif; ?>
                                        <?php if(isset($obj->expiry_days) && !empty($obj->expiry_days)): ?>
                                            <p class="pb-7 rgb-71">
                                                <span class=""><?php echo app('translator')->get('index.expiry_date'); ?>:</span>
                                                <?php echo e($obj->complete_date != null || $obj->expiry_days != null ? getDateFormat(expireDate($obj->complete_date, $obj->expiry_days)) : 'N/A'); ?>

                                            </p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                            <h5><?php echo app('translator')->get('index.raw_material_consumption_cost'); ?> (RoM)</h5>
                            <table class="w-100 mt-10">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-30 text-start"><?php echo app('translator')->get('index.raw_material'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.rate_per_unit'); ?></th>
                                        <th class="w-15 text-start"><?php echo app('translator')->get('index.consumption'); ?></th>
                                        <th class="w-20 text-right"><?php echo app('translator')->get('index.total_cost'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($m_rmaterials) && $m_rmaterials): ?>
                                        <?php
                                        $i = 1;
                                        ?>
                                        <?php $__currentLoopData = $m_rmaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="rowCount">
                                                <td class="width_1_p">
                                                    <p class="set_sn"><?php echo e($i++); ?></p>
                                                </td>
                                                <td class="text-start"><?php echo e(getRMName($value->rmaterials_id)); ?></td>
                                                <td class="text-start"><?php echo e(getAmtCustom($value->unit_price)); ?></td>
                                                <td class="text-start"><?php echo e($value->consumption); ?>

                                                    <?php echo e(getManufactureUnitByRMID($value->rmaterials_id)); ?>

                                                </td>
                                                <td class="text-right padding-0"><?php echo e(getAmtCustom($value->total_cost)); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-start fw-bold"><?php echo app('translator')->get('index.total_raw_material_cost'); ?> :</td>
                                        <td class="text-right fw-bold"><?php echo e(getAmtCustom($obj->mrmcost_total)); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <hr>
                            <h5><?php echo app('translator')->get('index.non_inventory_cost'); ?></h5>
                            <table class="w-100 mt-10">
                                <thead class="b-r-3 bg-color-000000">
                                    <tr>
                                        <th class="w-5 text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                                        <th class="w-40 text-start"><?php echo app('translator')->get('index.non_inventory_items'); ?></th>
                                        <th class="w-20 text-start"><?php echo app('translator')->get('index.non_inventory_cost'); ?></th>
                                        <th class="w-20 text-right"><?php echo app('translator')->get('index.account'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($m_nonitems) && $m_nonitems): ?>
                                        <?php
                                        $j = 1;
                                        ?>
                                        <?php $__currentLoopData = $m_nonitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="rowCount">
                                                <td class="width_1_p">
                                                    <p class="set_sn"><?php echo e($j++); ?></p>
                                                </td>
                                                <td class="text-start"> <?php echo e(getNonInventroyItem($value->noninvemtory_id)); ?>

                                                </td>
                                                <td class="text-start padding-0"><?php echo e(getAmtCustom($value->nin_cost)); ?></td>
                                                <td class="text-right"><?php echo e(getAccountName($value->account_id)); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td class="text-start fw-bold"><?php echo app('translator')->get('index.total_non_inventory_cost'); ?> :</td>
                                        <td class="text-start fw-bold"><?php echo e(getAmtCustom($obj->mnoninitem_total)); ?></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php if(isset($m_stages) && $m_stages && count($m_stages) > 0): ?>
                                <hr>
                                <h5><?php echo app('translator')->get('index.manufacture_stages'); ?></h5>
                                <table class="w-100 mt-10">
                                    <thead class="b-r-3 bg-color-000000">
                                        <tr>
                                            <th class="w-5 text-left"><?php echo app('translator')->get('index.sn'); ?></th>
                                            <th class="w-30 text-left"><?php echo app('translator')->get('index.stage'); ?></th>
                                            <th class="w-15 text-center"><?php echo app('translator')->get('index.required_months'); ?></th>
                                            <th class="w-15 text-center"><?php echo app('translator')->get('index.required_days'); ?></th>
                                            <th class="w-15 text-center"><?php echo app('translator')->get('index.required_hour'); ?></th>
                                            <th class="w-15 text-center"><?php echo app('translator')->get('index.required_minute'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($m_stages) && $m_stages): ?>
                                            <?php
                                            $k = 1;
                                            $total_month = 0;
                                            $total_day = 0;
                                            $total_hour = 0;
                                            $total_mimute = 0;
                                            ?>
                                            <?php $__currentLoopData = $m_stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $checked = '';
                                                $tmp_key = $key + 1;
                                                if ($obj->stage_counter == $tmp_key) {
                                                    $checked = 'checked=checked';
                                                }
                                                $total_value = $value->stage_month * 2592000 + $value->stage_day * 86400 + $value->stage_hours * 3600 + $value->stage_minute * 60;
                                                $months = floor($total_value / 2592000);
                                                $hours = floor(($total_value % 86400) / 3600);
                                                $days = floor(($total_value % 2592000) / 86400);
                                                $minuts = floor(($total_value % 3600) / 60);
                                                
                                                $total_month += $months;
                                                $total_hour += $hours;
                                                $total_day += $days;
                                                $total_mimute += $minuts;
                                                
                                                $total_stages = $total_month * 2592000 + $total_hour * 3600 + $total_day * 86400 + $total_mimute * 60;
                                                $total_months = floor($total_stages / 2592000);
                                                $total_hours = floor(($total_stages % 86400) / 3600);
                                                $total_days = floor(($total_stages % 2592000) / 86400);
                                                $total_minutes = floor(($total_stages % 3600) / 60);
                                                
                                                ?>
                                                <tr class="rowCount">
                                                    <td class="width_1_p">
                                                        <p class="set_sn"><?php echo e($k++); ?></p>
                                                    </td>
                                                    <td class="text-left">
                                                        <?php echo e(getProductionStages($value->productionstage_id)); ?></td>
                                                    <td class="text-center"><?php echo e($value->stage_month); ?></td>
                                                    <td class="text-center"><?php echo e($value->stage_day); ?>

                                                    </td>
                                                    <td class="text-center"><?php echo e($value->stage_hours); ?>

                                                    </td>
                                                    <td class="text-center"><?php echo e($value->stage_minute); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right pr-10"><?php echo app('translator')->get('index.total'); ?> :</td>
                                            <td class="text-center">
                                                <?php echo e(isset($total_months) && $total_months ? $total_months : ''); ?></td>
                                            <td class="text-center">
                                                <?php echo e(isset($total_days) && $total_days ? $total_days : ''); ?>

                                            </td>
                                            <td class="text-center">
                                                <?php echo e(isset($total_hours) && $total_hours ? $total_hours : ''); ?></td>
                                            <td class="text-center">
                                                <?php echo e(isset($total_minutes) && $total_minutes ? $total_minutes : ''); ?>

                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php endif; ?>
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
                                            <h4 class="d-block pb-10"><?php echo app('translator')->get('index.files'); ?></h4>
                                            <div class="">
                                                <?php if(isset($obj->file) && $obj->file): ?>
                                                    <?php ($files = explode(',', $obj->file)); ?>
                                                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php ($fileExtension = pathinfo($file, PATHINFO_EXTENSION)); ?>
                                                        <?php if($fileExtension == 'pdf'): ?>
                                                            <a class="text-decoration-none"
                                                                href="<?php echo e($baseURL); ?>uploads/manufacture/<?php echo e($file); ?>"
                                                                target="_blank">
                                                                <img src="<?php echo e($baseURL); ?>assets/images/pdf.png"
                                                                    alt="PDF Preview" class="img-thumbnail mx-2"
                                                                    width="100px">
                                                            </a>
                                                        <?php elseif($fileExtension == 'doc' || $fileExtension == 'docx'): ?>
                                                            <a class="text-decoration-none"
                                                                href="<?php echo e($baseURL); ?>uploads/manufacture/<?php echo e($file); ?>"
                                                                target="_blank">
                                                                <img src="<?php echo e($baseURL); ?>assets/images/word.png"
                                                                    alt="Word Preview" class="img-thumbnail mx-2"
                                                                    width="100px">
                                                            </a>
                                                        <?php else: ?>
                                                            <a class="text-decoration-none"
                                                                href="<?php echo e($baseURL); ?>uploads/manufacture/<?php echo e($file); ?>"
                                                                target="_blank">
                                                                <img src="<?php echo e($baseURL); ?>uploads/manufacture/<?php echo e($file); ?>"
                                                                    alt="File Preview" class="img-thumbnail mx-2"
                                                                    width="100px">
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="w-50">
                                        <table class="mt-10 mb-10">
                                            <tr>
                                                <td class="w-50 border-top-dotted-gray border-bottom-dotted-gray">
                                                    <p class=""><?php echo app('translator')->get('index.tax'); ?> :</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php ($collect_tax = $tax_items->collect_tax); ?>
                                        <?php ($tax_information = json_decode(
                                                isset($obj->tax_information) && $obj->tax_information
                                                    ? $obj->tax_information
                                                    : '',
                                            )); ?>
                                        <?php $__currentLoopData = $tax_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($tax_information): ?>
                                                <?php $__currentLoopData = $tax_information; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($tax_field->id == $single_tax->tax_field_id): ?>
                                                        <table>
                                                            <tr>
                                                                <td class="w-50">
                                                                    <p class=""><?php echo e($tax_field->tax); ?></p>
                                                                </td>
                                                                <td class="w-50 text-right">
                                                                    <p><?php echo e(intval($single_tax->tax_field_percentage)); ?>%</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class=""><?php echo app('translator')->get('index.total_cost'); ?></p>
                                                </td>
                                                <td class="w-50 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->mtotal_cost)); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td class="w-50">
                                                    <p class=""><?php echo app('translator')->get('index.profit_margin'); ?> (%)</p>
                                                </td>
                                                <td class="w-50 text-right">
                                                    <p><?php echo e($obj->mprofit_margin); ?></p>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="mt-10 mb-10">
                                            <tr>
                                                <td class="w-50 border-top-dotted-gray border-bottom-dotted-gray">
                                                    <p class=""><?php echo app('translator')->get('index.sale_price'); ?> :</p>
                                                </td>
                                                <td class="w-50 text-right">
                                                    <p><?php echo e(getAmtCustom($obj->msale_price)); ?></p>
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
    <script type="text/javascript" src="<?php echo $baseURL . 'assets/bower_components/gantt/js/jquery.fn.gantt.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $baseURL . 'assets/bower_components/gantt/js/jquery.cookie.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/addManufactures.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $baseURL . 'frequent_changing/js/genchat.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/js/manufacture.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\manufacture\viewDetails.blade.php ENDPATH**/ ?>