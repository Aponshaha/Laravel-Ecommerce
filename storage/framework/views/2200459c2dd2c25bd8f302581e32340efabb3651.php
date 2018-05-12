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
          <h1 class="page-header">Orders List</h1>
          <a href="<?php echo e(URL::to('/admin/download/')); ?>/<?php echo e($data['orders_details']->order_row_id); ?>" class="btn btn-info"> Preview & Print Invoice</a> <br/><br/>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Orders 
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover dataTables">
                  <caption class="text-center">ORD-<?php echo e(sprintf('%06d',$data['orders_details']->order_row_id)); ?></caption>
                    <thead>
                      <tr>
                       
                        <th class="cart_product">Product Code</th>
                        <th class="cart_product" width="160px">Image</th>
                        <th class="text-center">Unit price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Total</th> 
                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = json_decode($data['orders_details']->order_details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr><td><?php echo e($od->product_name); ?></td>
                       <td><img src="<?php echo e(url('uploads/products')); ?>/<?php echo e($od->product_image); ?>" height="150" width="140"></td>
                      <td class="text-right"><?php echo e($od->product_price); ?></td>
                      <td class="text-right"><?php echo e($od->product_qty); ?></td>
                        <td class="text-right"><?php echo e($od->product_total_price); ?></td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" class="text-right">Total :</td>
                        <td colspan="4" class="text-right"><?php echo e($data['total_price']); ?></td>
                      </tr>

                    </tfoot>
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
  $('.deleteLink').click( function() {
    if( confirm('Are you sure to Delete ? ') ){
      var deleteID = $(this).attr('deleteID');   
      window.location.href = "<?php echo e(url('/')); ?>/admin/blog/deleteRecord/" + deleteID;    
    }      
  }); 
 </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>