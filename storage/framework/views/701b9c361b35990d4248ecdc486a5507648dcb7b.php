<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Categories List</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Category
              </div>
              <!-- /.panel-heading -->
            <div class="panel-body">
               <table width="100%" class="table table-striped table-bordered table-hover dataTables">
                          <thead>
                              <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                 <tbody>  
                      <?php $__currentLoopData = $data['all_records']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                     <tr>            
                        <td> 
                         <?php if($row->level == 0): ?> <b>  <?php endif; ?> 
                         <?php if($row->level == 1): ?> &nbsp; - <?php endif; ?>   
                         <?php if($row->level == 2): ?> &nbsp; &nbsp; - - <?php endif; ?>     
                         <?php if($row->level == 3): ?> &nbsp; &nbsp; &nbsp; - - - <?php endif; ?>       
                         <?php if($row->level == 4): ?> &nbsp; &nbsp; &nbsp; &nbsp; - - - - <?php endif; ?>       
                         <?php if($row->level == 5): ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  - - - - - <?php endif; ?>       
                         <?php if($row->level > 5): ?>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - - - <?php endif; ?>
                         
                         <?php echo e($row->category_name); ?> 
                         <?php if($row->level == 0): ?> </b>  <?php endif; ?> 
                         </td> 
                        
                        <td>
                          <button onclick="window.location='<?php echo e(url('/')); ?>/admin/category/edit/<?php echo e($row->category_row_id); ?>'" class="btn btn-warning mb-2">Edit</button>
                          <?php if( !$row->has_child ): ?>  
                          <button deleteID="<?php echo e($row->category_row_id); ?>"  class="btn btn-danger deleteLink">Delete</button>
                          <?php endif; ?>
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

<?php $__env->startSection('page_level_js'); ?>
<script type="text/javascript"> 
 $('.deleteLink').click( function() {
  if( confirm('Are you sure to Delete ? ') )
  {
   var deleteID = $(this).attr('deleteID');   
    window.location.href = "<?php echo e(url('/')); ?>/admin/category/deleteRecord/" + deleteID;    
  }
        
 });
 
 </script> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>