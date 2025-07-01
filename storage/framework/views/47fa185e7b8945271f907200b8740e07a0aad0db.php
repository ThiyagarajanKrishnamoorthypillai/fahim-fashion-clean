
<?php $__env->startSection('content'); ?>
    <?php
    $baseURL = getBaseURL();
    $whiteLabelInfo = getWhiteLabelInfo();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
    ?>

    <section class="main-content-wrapper">
        <section class="content-header dashboard_content_header my-2">
            <h3 class="top-left-header">
                <span><?php echo app('translator')->get('index.white_label_settings'); ?></span>
            </h3>
        </section>

        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="box-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-box">
                        <?php echo Form::model(isset($whiteLabelInfo) && $whiteLabelInfo ? $whiteLabelInfo : '', [
                            'method' => 'POST',
                            'id' => 'update_white_label',
                            'enctype' => 'multipart/form-data',
                            'route' => ['white-label-update'],
                        ]); ?>

                        <?php echo csrf_field(); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('index.site_title'); ?> <span class="required_star">*</span></label>
                                       <input type="text" name="site_title" id="site_title" class="form-control <?php $__errorArgs = ['site_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Site Titile" value="<?php echo e(isset($whiteLabelInfo->site_title) ? $whiteLabelInfo->site_title : null); ?>">
                                        <?php $__errorArgs = ['site_title'];
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


                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('index.footer'); ?> <span class="required_star">*</span></label>
                                        <input type="text" name="footer" id="footer" class="form-control <?php $__errorArgs = ['footer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Footer Text" value="<?php echo e(isset($whiteLabelInfo->footer) ? $whiteLabelInfo->footer : null); ?>">
                                        <?php $__errorArgs = ['footer'];
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
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('index.company_name'); ?> <span class="required_star">*</span></label>
                                        <input type="text" name="company_name" id="company_name" class="form-control <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Company Name" value="<?php echo e(isset($whiteLabelInfo->company_name) ? $whiteLabelInfo->company_name : null); ?>">
                                        <?php $__errorArgs = ['company_name'];
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
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('index.company_website'); ?></label>
                                        <input type="text" name="company_website" id="web_site" class="form-control <?php $__errorArgs = ['company_website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Website" value="<?php echo e(isset($whiteLabelInfo->company_website) ? $whiteLabelInfo->company_website : null); ?>">
                                        <?php $__errorArgs = ['company_website'];
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

                                <div class="mb-3 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group custom_table">
                                        <label><?php echo app('translator')->get('index.favicon'); ?> (<?php echo app('translator')->get('index.favicon_instruction'); ?>)</label>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden"
                                                            value="<?php echo e(isset($whiteLabelInfo->favicon) && $whiteLabelInfo->favicon ? $whiteLabelInfo->favicon : ''); ?>"
                                                            name="favicon_old">
                                                        <input type="file" name="favicon" id="favicon" class="form-control <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> file_checker_global" accept="image/ico" data-this_file_size_limit="50">

                                                    </td>
                                                    <td class="w_1">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#view_favicon_preview"
                                                            class="btn btn-md pull-right fit-content bg-second-btn view_modal_button ms-2"
                                                            id="favicon_preview"><iconify-icon
                                                                icon="solar:eye-broken"></iconify-icon></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="text-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="mb-3 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group custom_table">
                                        <label><?php echo app('translator')->get('index.logo'); ?> (<?php echo app('translator')->get('index.logo_instructions'); ?>)</label>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden"
                                                            value="<?php echo e(isset($whiteLabelInfo->logo) && $whiteLabelInfo->logo ? $whiteLabelInfo->logo : ''); ?>"
                                                            name="logo_old">
                                                        <input type="file" name="logo" id="logo" class="form-control <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> file_checker_global" accept="image/png,image/jpeg,image/jpg,image/gif" data-this_file_size-limit="1">

                                                    </td>
                                                    <td class="w_1">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#view_logo_preview"
                                                            class="btn btn-md pull-right fit-content bg-second-btn view_modal_button ms-2"
                                                            id="logo_preview"><iconify-icon
                                                                icon="solar:eye-broken"></iconify-icon></button>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="text-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group custom_table">
                                        <label><?php echo app('translator')->get('index.mini_logo'); ?> (<?php echo app('translator')->get('index.mini_logo_instructions'); ?>)</label>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden"
                                                            value="<?php echo e(isset($whiteLabelInfo->mini_logo) && $whiteLabelInfo->mini_logo ? $whiteLabelInfo->mini_logo : ''); ?>"
                                                            name="mini_logo_old">
                                                        <input type="file" name="mini_logo" id="mini_logo" class="form-control <?php $__errorArgs = ['mini_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> file_checker_global" accept="image/png,image/jpeg,image/jpg,image/gif" data-this_file_size-limit="1">

                                                    </td>
                                                    <td class="w_1">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#view_mini_logo_preview"
                                                            class="btn btn-md pull-right fit-content bg-second-btn view_modal_button ms-2"
                                                            id="mini_logo_preview"><iconify-icon
                                                                icon="solar:eye-broken"></iconify-icon></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php $__errorArgs = ['mini_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="text-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row py-2">
                                    <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                                        <button type="submit" name="submit" value="submit"
                                            class="btn bg-blue-btn"><iconify-icon
                                                icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <?php echo Form::close(); ?>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="view_logo_preview" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('index.logo'); ?> </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            <img class="img-fluid"
                                src="<?php echo e($baseURL); ?>uploads/white_label/<?php echo e($whiteLabelInfo->logo ?? ''); ?>"
                                id="show_id">
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-blue-btn" data-dismiss="modal"
                            data-bs-dismiss="modal"><?php echo app('translator')->get('index.close'); ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="view_mini_logo_preview" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('index.mini_logo'); ?> </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            <img class="img-fluid"
                                src="<?php echo e($baseURL); ?>uploads/white_label/<?php echo e(isset($whiteLabelInfo->mini_logo) && $whiteLabelInfo->mini_logo ? $whiteLabelInfo->mini_logo : ''); ?>"
                                id="show_id">
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-blue-btn" data-dismiss="modal"
                            data-bs-dismiss="modal"><?php echo app('translator')->get('index.close'); ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="view_favicon_preview" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('index.favicon'); ?> </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                data-feather="x"></i></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            <img class="img-fluid"
                                src="<?php echo e($baseURL); ?>uploads/white_label/<?php echo e(isset($whiteLabelInfo->favicon) && $whiteLabelInfo->favicon ? $whiteLabelInfo->favicon : ''); ?>"
                                id="show_id">
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-blue-btn" data-dismiss="modal"
                            data-bs-dismiss="modal"><?php echo app('translator')->get('index.close'); ?></button>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script_bottom'); ?>
    <script src="<?php echo $baseURL . 'frequent_changing/js/whitelabel.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\white-label.blade.php ENDPATH**/ ?>