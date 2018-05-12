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
                    <thead>
                        <tr>
                        <th>Order ID </th>
                        <th>Customer Name</th>
                        <th>Shipping Address</th>
                        <th>Total Price </th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  

                          <?php $__currentLoopData = $data['orders_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $shiping_address=json_decode($row->shiping_address);
                              $order_status=$row->order_status;
                               ?>

                          <tr class="table table-bordered table-hover">            
                          <td> ORD -  <?php echo e(sprintf('%06d', $row->order_row_id)); ?> </td>
                          <td> <?php echo e($shiping_address->name); ?> </td>
                          <td> 
                          <p>  <label>Address:</label>  <?php echo e($shiping_address->address); ?></p>
                          <p> <label> Mobile:</label> <?php echo e($shiping_address->mobile); ?></p>
                          <p> <label>E-mail:</label>  <?php echo e($shiping_address->email); ?></p>
                          </td>

                          <td> <?php echo $row->total_price; ?> </td>

                          <td> <a href="<?php echo e(asset('/admin/orders/details/')); ?>/<?php echo e($row->order_row_id); ?>" class="btn btn-default">Details</a> &nbsp;&nbsp;
                          <a href="#smsModal" data-toggle="modal" data-mobile="<?php echo e($shiping_address->mobile); ?>" class="btn btn-default">  Send SMS </a>

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

  <!--SMS  Modal -->
  <div class="modal fade" id="smsModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@Send  SMS</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="#">
                  <?php echo csrf_field(); ?>

        <div class="form-group">
          <label for="mobile">Mobile</label>
          <input type="text" class="form-control" id="mobile" value="" name="mobile" required>
        </div>
        <div class="form-group">
          <label for="pwd">Message</label>
          <textarea class="form-control" rows="6" name="message" style="resize: none;" id="message" placeholder="Write message here !!!" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
  </div>
  <!--SMS  Modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_specific_include_js_file'); ?>
<script src="<?php echo e(asset('sb-admin/vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('sb-admin/vendor/datatables-plugins/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('sb-admin/vendor/datatables-responsive/dataTables.responsive.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_js'); ?>
<script type="text/javascript">
    $('#smsModal').on('show.bs.modal', function (e) {
      var mobile = $(e.relatedTarget).data('mobile');
      $("#mobile").attr("value", mobile);
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>