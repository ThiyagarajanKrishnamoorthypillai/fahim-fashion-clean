
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
            <form action="<?php echo e(request()->url()); ?>" class="updateStatus mb-2" method="get">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-select" name="status" id="status_input" aria-label="Default select example" onchange="this.form.submit()">
                            <option selected>Select Status</option>
                            <option value="1" <?php echo e($status == 1 ? 'selected' : ''); ?>>Present</option>
                            <option value="0" <?php echo e($status == 0 ? 'selected' : ''); ?>>Absent</option>
                        </select>
                    </div>
                </div>
            </form>          
            <div class="table-box">				
                <!-- /.box-header -->                
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped attendance-table">
                        <thead>
                            <tr>
                            <tr>
                                <th class="width_1_p"><?php echo app('translator')->get('index.sn'); ?></th>
                                <th class="width_5_p"><?php echo app('translator')->get('index.reference_no'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.date'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.employee'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.in_time'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.out_time'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.update_time'); ?></th>
								<th class="width_10_p"><?php echo app('translator')->get('index.status'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.time_count'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.note'); ?></th>
                                <th class="width_10_p"><?php echo app('translator')->get('index.added_by'); ?></th>
                                <th class="width_3_p ir_txt_center"><?php echo app('translator')->get('index.actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($obj && !empty($obj)): ?>
                                <?php
                                $i = count($obj);
                                ?>
                            <?php endif; ?>
                            <?php $__currentLoopData = $obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i--); ?></td>
                                    <td><?php echo e($value->reference_no); ?></td>
                                    <td><?php echo e(getDateFormat($value->date)); ?></td>
                                    <td><?php echo e($value->user->name); ?></td>
                                    <td><?php echo e($value->in_time); ?></td>
                                    <td><?php echo e($value->out_time ?? 'N/A'); ?></td>
                                    <td>
                                    <?php if(routePermission('attendance.edit')): ?>
                                    <a href="<?php echo e(url('attendance/' . encrypt_decrypt($value->id, 'encrypt') . '/edit')); ?>"><?php echo app('translator')->get('index.update_time'); ?>
                                    <?php endif; ?>
                                    </a>
                                    </td>
									<td>
										<form action="<?php echo e(route('attendance.updateStatus')); ?>"
                                                    class="updateStatus" method="post">
											<?php echo csrf_field(); ?>
											<input type="hidden" name="id" value="<?php echo e($value->id); ?>" />
											<select class="form-select" name="status" id="status_input" aria-label="Default select example" onchange="this.form.submit()">
											  <option selected>Select Status</option>
											  <option value="1" <?php echo e($value->status == 1 ? 'selected' : ''); ?>>Present</option>
											  <option value="0" <?php echo e($value->status == 0 ? 'selected' : ''); ?>>Absent</option>
											</select>
										</form>
									</td>
                                    <td>
                                        <?php if($value->out_time == '00:00:00'): ?>
                                            N/A
                                        <?php else: ?>
                                            <?php
                                                $get_hour = getTotalHour($value->out_time, $value->in_time);
                                            ?>
                                            <?php if(isset($get_hour) && $get_hour): ?>
                                                <?php echo e($get_hour); ?> Hour(s)
                                            <?php else: ?>
                                                0 Hour(s)
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(safe($value->note)); ?></td>
                                    <td><?php echo e($value->addedBy->name ?? 'N/A'); ?></td>
                                    <td class="ir_txt_center">
                                        <?php if(routePermission('attendance.delete')): ?>
                                            <a href="#" class="delete button-danger"
                                                data-form_class="alertDelete<?php echo e($value->id); ?>" type="submit"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo app('translator')->get('index.delete'); ?>">
                                                <form action="<?php echo e(route('attendance.destroy', $value->id)); ?>"
                                                    class="alertDelete<?php echo e($value->id); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <i class="fa fa-trash tiny-icon"></i>
                                                </form>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo $baseURL . 'assets/datatable_custom/jquery-3.3.1.js'; ?>"></script>	
	<script src="<?php echo $baseURL.'assets/plugins/local/jquery.timepicker.min.js'; ?>"></script>
	<link rel="stylesheet" href="<?php echo $baseURL.'assets/plugins/local/jquery.timepicker.min.css'; ?>">
	
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CodeSpace\Fahim-Fashion\resources\views\pages\attendance\index.blade.php ENDPATH**/ ?>