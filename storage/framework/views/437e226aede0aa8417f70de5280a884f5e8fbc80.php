<?php $__env->startSection('page_specific_include_css_file'); ?>
<!-- DataTables CSS -->
<link href="<?php echo e(asset('sb-admin/vendor/datatables-plugins/dataTables.bootstrap.css')); ?>" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="<?php echo e(asset('sb-admin/vendor/datatables-responsive/dataTables.responsive.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Products List</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Products
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                          <th>Product Name</th>              
                          <th> Price</th>   
                          <th>Image</th>          
                          <th>Category Name</th>       
                          <th>Special</th>     
                          <th>Featured</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data['products_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                        <tr>            
                        <td><?php echo e($row->product_name); ?></td> 
                        <td><?php echo e($row->product_price); ?></td>            
                        <td><img alt="product" style="width:50px;height:50px" src="<?php echo e(asset('/uploads')); ?>/products/<?php echo e($row->product_image); ?>"></td>            
                        <td><?php echo e(isset($row->category_info->category_name) ? $row->category_info->category_name : ''); ?></td>            
                        <td><?php echo e($row->is_latest ? 'Yes' : ''); ?></td>
                        <td><?php echo e($row->is_featured ? 'Yes' : ''); ?></td>                       
                        <td>
                            <button onclick="window.location='<?php echo e(url('/')); ?>/admin/product/edit/<?php echo e($row->product_row_id); ?>'" class="btn btn-warning mb-2">Edit</button>
                            <button deleteID="<?php echo e($row->product_row_id); ?>"  class="btn btn-danger deleteLink">Delete</button> 
                        </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_specific_include_js_file'); ?>
<script src="<?php echo e(asset('sb-admin/vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('sb-admin/vendor/datatables-plugins/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('sb-admin/vendor/datatables-responsive/dataTables.responsive.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_js'); ?>
<script type="text/javascript">
   $('.deleteLink') . click( function() {
    if( !confirm('Are you sure you want to delete ?'))
    return false;
	
	   var id  = $(this).attr('deleteID');	
	   window.location.href = "<?php echo e(url('/')); ?>/admin/product/deleteRecord/" + id;
   
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>