
<?php $__env->startSection('content'); ?>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
    ?>
    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header"><?php echo e(isset($title) && $title ? $title : ''); ?></h2>
                    <input type="hidden" class="datatable_name" data-title="<?php echo e(isset($title) && $title ? $title : ''); ?>"
                        data-id_name="datatable">
                </div>
                <div class="col-md-offset-4 col-md-2">

                </div>
            </div>
        </section>


        <div class="box-wrapper">
            <form action="<?php echo e(route('forecasting.product.view')); ?>" method="get">
                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-6">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="form-group w-50">
                                <label><?php echo app('translator')->get('index.product'); ?> <span class="required_star">*</span></label>
                                <select class="form-control <?php $__errorArgs = ['product'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2" name="product"
                                    id="product_id">
                                    <option value=""><?php echo app('translator')->get('index.select_product'); ?></option>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>|<?php echo e($value->name); ?>|<?php echo e($value->code); ?>"><?php echo e($value->name); ?>

                                            (<?php echo e($value->code); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity"><?php echo app('translator')->get('index.quantity'); ?> <span class="required_star">*</span></label>
                                <input type="number" class="form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="quantity" name="quantity" placeholder="<?php echo app('translator')->get('index.enter_quantity'); ?>">
                            </div>
                            <button type="button" class="btn bg-blue-btn mt-4" id="add_product"><iconify-icon
                                    icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.add'); ?></button>
                        </div>
                        <p id="product_error" class="text-danger d-none">Product is required</p>
                        <p id="quantity_error" class="text-danger d-none">Quantity is required</p>
                        <p id="product_duplicate_error" class="text-danger d-none">Product already added</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-6">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('index.sn'); ?></th>
                                    <th><?php echo app('translator')->get('index.product'); ?></th>
                                    <th><?php echo app('translator')->get('index.quantity'); ?></th>
                                    <th><?php echo app('translator')->get('index.actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="product_list">
                                <p class="text-danger d-none" id="product_list_error">Please add at least one product</p>
                            </tbody>
                        </table>
                        <button type="submit" class="btn bg-blue-btn mt-4" id="forecast_product"><iconify-icon
                                icon="carbon:forecast-lightning"></iconify-icon><?php echo app('translator')->get('index.forecast'); ?></button>
                    </div>
                </div>
            </form>            
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo $baseURL . 'assets/datatable_custom/jquery-3.3.1.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/dataTables.bootstrap4.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/dataTables.buttons.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/buttons.html5.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/buttons.print.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/jszip.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/pdfmake.min.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'assets/dataTable/vfs_fonts.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/newDesign/js/forTable.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/js/custom_report.js'; ?>"></script>
    <script src="<?php echo $baseURL . 'frequent_changing/js/forecasting.js'; ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\forecasting\product.blade.php ENDPATH**/ ?>