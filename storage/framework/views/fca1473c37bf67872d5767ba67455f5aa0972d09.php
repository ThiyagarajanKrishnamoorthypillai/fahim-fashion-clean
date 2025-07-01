
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
            <div class="col-sm-12 mb-2 col-md-6">
                <form action="<?php echo e(request()->url()); ?>" method="get">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="form-group w-50">
                            <label><?php echo app('translator')->get('index.raw_material'); ?> <span class="required_star">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['raw_material'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2" name="raw_material"
                                id="raw_material_id">
                                <option value=""><?php echo app('translator')->get('index.select_raw_materials'); ?></option>
                                <?php $__currentLoopData = $rawMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php echo e(encrypt_decrypt(request()->get('raw_material'), 'decrypt') == $value->id ? 'selected' : ''); ?> value="<?php echo e(encrypt_decrypt($value->id, 'encrypt')); ?>"><?php echo e($value->name); ?>(<?php echo e($value->code); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn bg-blue-btn mt-4"><iconify-icon
                                icon="solar:check-circle-broken"></iconify-icon><?php echo app('translator')->get('index.filter'); ?></button>
                    </div>
                </form>
            </div>
            <?php if(isset($obj) && $obj != null): ?>
            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="w-5"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.name'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.code'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.category'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.unit'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.date'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.supplier'); ?></th>
                                <th class="w-15"><?php echo app('translator')->get('index.price_per_unit'); ?></th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <?php $__currentLoopData = $obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = priceHistory($value->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $i = $loop->iteration;
                                ?>
                                <tr>
                                    <td class="c_center"><?php echo e($i--); ?></td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td><?php echo e($value->code); ?></td>
                                    <td><?php echo e(getCategoryById($value->category)); ?></td>
                                    <td><?php echo e(getRMUnitById($value->unit)); ?></td>
                                    <td><?php echo e(getDateFormat($history->purchase->date)); ?></td>
                                    <td><?php echo e(getSupplierName($history->purchase->supplier)); ?></td>
                                    <td><?php echo e(getCurrency($history->unit_price)); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                    <!-- /.box-body -->
                </div>
            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\rawmaterial\priceHistory.blade.php ENDPATH**/ ?>