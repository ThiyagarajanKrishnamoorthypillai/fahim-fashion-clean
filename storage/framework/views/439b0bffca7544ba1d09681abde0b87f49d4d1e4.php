
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
            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">
                                    <h5><?php echo app('translator')->get('index.category'); ?> A 
                                    </h5>
                                    <small class="text-center text-danger"><?php echo app('translator')->get('index.category_a_instruction'); ?> <?php echo app('translator')->get('index.category_a_example'); ?></small>
                                </th>
                            </tr>
                            <tr>
                                <th class="op_width_1_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="op_width_9_p"><?php echo app('translator')->get('index.name'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                <th class="op_width_18_p"><?php echo app('translator')->get('index.category'); ?></th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.total_value'); ?></th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.cumulative_value'); ?>
                                    <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('index.cumulative_instruction'); ?>" class="fa fa-question-circle fa-lg base_color c_pointer"></i>
                                </th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.percentage'); ?>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if (!empty($obj['a'])) {
                            $i = count($obj['a']);
                            foreach ($obj['a'] as $value) {
                        ?>
                            <tr>
                                <td><?php echo e($i--); ?></td>
                                <td><?php echo e($value->name); ?>(<?php echo e($value->code); ?>)</td>
                                <td><?php echo e(getCategoryById($value->category)); ?></td>
                                <td><?php echo e(getCurrency($value->total_value)); ?></td>
                                <td><?php echo e(getCurrency($value->cumulative_value)); ?></td>
                                <td><?php echo e(number_format($value->percentage, 2)); ?>%</td>
                            </tr>
                            <?php
                            }
                        }
                        ?>

                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">
                                    <h5><?php echo app('translator')->get('index.category'); ?> B</h5>
                                    <small class="text-center text-danger"><?php echo app('translator')->get('index.category_b_instruction'); ?> <?php echo app('translator')->get('index.category_b_example'); ?></small>
                                </th>
                            </tr>
                            <tr>
                                <th class="op_width_1_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="op_width_9_p"><?php echo app('translator')->get('index.name'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                <th class="op_width_18_p"><?php echo app('translator')->get('index.category'); ?></th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.total_value'); ?></th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.cumulative_value'); ?>
                                    <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('index.cumulative_instruction'); ?>" class="fa fa-question-circle fa-lg base_color c_pointer"></i>
                                </th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.percentage'); ?>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if (!empty($obj['b'])) {
                            $i = count($obj['b']);
                            foreach ($obj['b'] as $value) {
                        ?>
                            <tr>
                                <td><?php echo e($i--); ?></td>
                                <td><?php echo e($value->name); ?>(<?php echo e($value->code); ?>)</td>
                                <td><?php echo e(getCategoryById($value->category)); ?></td>
                                <td><?php echo e(getCurrency($value->total_value)); ?></td>
                                <td><?php echo e(getCurrency($value->cumulative_value)); ?></td>
                                <td><?php echo e(number_format($value->percentage, 2)); ?>%</td>
                            </tr>
                            <?php
                            }
                        }
                        ?>

                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">
                                    <h5><?php echo app('translator')->get('index.category'); ?> C</h5>
                                    <small class="text-center text-danger"><?php echo app('translator')->get('index.category_c_instruction'); ?> <?php echo app('translator')->get('index.category_c_example'); ?></small>
                                </th>
                            </tr>
                            <tr>
                                <th class="op_width_1_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="op_width_9_p"><?php echo app('translator')->get('index.name'); ?>(<?php echo app('translator')->get('index.code'); ?>)</th>
                                <th class="op_width_18_p"><?php echo app('translator')->get('index.category'); ?></th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.total_value'); ?></th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.cumulative_value'); ?>
                                    <i data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('index.cumulative_instruction'); ?>" class="fa fa-question-circle fa-lg base_color c_pointer"></i>
                                </th>
                                <th class="op_width_10_p"><?php echo app('translator')->get('index.percentage'); ?>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if (!empty($obj['c'])) {
                            $i = count($obj['c']);
                            foreach ($obj['c'] as $value) {
                        ?>
                            <tr>
                                <td><?php echo e($i--); ?></td>
                                <td><?php echo e($value->name); ?>(<?php echo e($value->code); ?>)</td>
                                <td><?php echo e(getCategoryById($value->category)); ?></td>
                                <td><?php echo e(getCurrency($value->total_value)); ?></td>
                                <td><?php echo e(getCurrency($value->cumulative_value)); ?></td>
                                <td><?php echo e(number_format($value->percentage, 2)); ?>%</td>
                            </tr>
                            <?php
                            }
                        }
                        ?>

                        </tbody>
                    </table>

                </div>
            </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\abc_report.blade.php ENDPATH**/ ?>