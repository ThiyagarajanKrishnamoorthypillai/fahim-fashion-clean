
<?php $__env->startSection('content'); ?>
<?php
$baseURL = getBaseURL();
$setting = getSettingsInfo();
$base_color = "#6ab04c";
if (isset($setting->base_color) && $setting->base_color) {
    $base_color = $setting->base_color;
}
?>
<section class="main-content-wrapper">
    <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="top-left-header"><?php echo e(isset($title) && $title?$title:''); ?></h2>
                <input type="hidden" class="datatable_name" data-title="<?php echo e(isset($title) && $title?$title:''); ?>" data-id_name="datatable">
            </div>
            <div class="col-md-offset-4 col-md-2">

            </div>
        </div>
    </section>

    <?php if($startDate != '' || $endDate != ''): ?>
    <div class="my-2">
        <h4 class="ir_txtCenter_mt0">
            Date:
            <?php echo e(($startDate != '') ? getDateFormat($startDate):''); ?>

            <?php echo e(($endDate != '') ? ' - '.getDateFormat($endDate):''); ?>

        </h4>
    </div>
    <?php endif; ?>

    <div class="box-wrapper">
        <?php echo e(Form::open(['route'=>'attendance-report', 'id' => "attendance_form", 'method'=>'get'])); ?>

        <div class="row">
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo Form::text('startDate', $startDate, ['class' => 'form-control customDatepicker', 'readonly'=>"", 'placeholder'=>"Start Date"]); ?>

                </div>
            </div>
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <?php echo Form::text('endDate', $endDate, ['class' => 'form-control customDatepicker', 'readonly'=>"", 'placeholder'=>"End Date"]); ?>

                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="form-group">
                    <button type="submit" value="submit" class="btn bg-blue-btn w-100"><?php echo app('translator')->get('index.submit'); ?></button>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>


        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-start"><?php echo app('translator')->get('index.sn'); ?></th>
                            <th class="op_width_11_p"><?php echo app('translator')->get('index.reference_no'); ?></th>
                            <th class="op_width_9_p"><?php echo app('translator')->get('index.date'); ?></th>
                            <th class="op_width_18_p"><?php echo app('translator')->get('index.employee'); ?></th>
                            <th class="op_width_10_p"><?php echo app('translator')->get('index.in_time'); ?></th>
                            <th class="op_width_10_p"><?php echo app('translator')->get('index.out_time'); ?></th>
                            <th class="op_width_14_p"><?php echo app('translator')->get('index.time_count'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_hours = 0;
                        if (!empty($obj)) {
                            $i = count($obj);
                            foreach ($obj as $value) {
                        ?>
                                <tr>
                                    <td class="text-start"><?php echo e($i--); ?></td>
                                    <td><?php echo e($value->reference_no); ?></td>
                                    <td><?php echo e(getDateFormat($value->date)); ?></td>
                                    <td><?php echo e(getUserName($value->employee_id)); ?></td>
                                    <td><?php echo e($value->in_time); ?></td>
                                    <td>
                                        <?php
                                        if ($value->out_time == '00:00:00') {
                                            echo 'N/A<br>';
                                        } else {
                                            echo $value->out_time;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($value->out_time == '00:00:00') {
                                            echo 'N/A';
                                        } else {
                                            $to_time = strtotime($value->out_time);
                                            $from_time = strtotime($value->in_time);
                                            $minute = round(abs($to_time - $from_time) / 60, 2);
                                            $hour = round(abs($minute) / 60, 2);
                                            echo $hour . " hours";
                                            $total_hours += $hour;
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b><?php echo app('translator')->get('index.total_hours'); ?></b></td>
                            <td><?php echo e($total_hours . " " . 'Hours'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo $baseURL.'assets/datatable_custom/jquery-3.3.1.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/jquery.dataTables.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/dataTables.bootstrap4.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/dataTables.buttons.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/buttons.html5.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/buttons.print.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/jszip.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/pdfmake.min.js'; ?>"></script>
<script src="<?php echo $baseURL.'assets/dataTable/vfs_fonts.js'; ?>"></script>
<script src="<?php echo $baseURL.'frequent_changing/newDesign/js/forTable.js'; ?>"></script>
<script src="<?php echo $baseURL.'frequent_changing/js/custom_report.js'; ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\report\attendance_report.blade.php ENDPATH**/ ?>