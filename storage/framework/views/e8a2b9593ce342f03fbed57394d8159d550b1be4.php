<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Category</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
          <div class="panel-heading">
                    Edit Category
          </div>
          <div class="panel-body">
            <div class="row">                             
                <?php echo e(Form::open(array('url' => 'admin/category/update'))); ?>  
                <input type="hidden"  name="category_row_id" value="<?php echo e($data['single_info']->category_row_id); ?>" />                          
                  <div class="col-lg-6">                                    
                    <div class="form-group">
                        <label>Category Name</label>
                         <input type="text" required value="<?php echo e($data['single_info']->category_name); ?>" class ="form-control" id="category_name" name="category_name" placeholder = "Enter category Name">
                       
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                       <select name="parent_id" class = "form-control" required>
                         <option value="" <?php if( $data['single_info']->parent_id == 0 ): ?> selected = "selected" <?php endif; ?>>Select</option>
                         <option value="0" <?php if( $data['single_info']->parent_id == 0 ): ?> selected = "selected" <?php endif; ?>> Main Category </option>
                          <?php $__currentLoopData = $data['all_records']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($row->category_row_id); ?>" <?php if( $data['single_info']->parent_id == $row->category_row_id ): ?> selected = "selected" <?php endif; ?>>
                               <?php if($row->level == 0): ?> <b>  <?php endif; ?>  
                               <?php if($row->level == 1): ?> &nbsp; - <?php endif; ?> 
                               <?php if($row->level == 2): ?> &nbsp; &nbsp; - - <?php endif; ?> 
                               <?php if($row->level == 2): ?> &nbsp; &nbsp; - - <?php endif; ?>     
                               <?php if($row->level == 3): ?> &nbsp; &nbsp; &nbsp; - - - <?php endif; ?>       
                               <?php if($row->level == 4): ?> &nbsp; &nbsp; &nbsp; &nbsp; - - - - <?php endif; ?>       
                               <?php if($row->level == 5): ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  - - - - - <?php endif; ?>       
                               <?php if($row->level > 5): ?>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - - - <?php endif; ?>  
                                          
                               <?php echo e($row->category_name); ?> 
                                <?php if($row->level == 0): ?> </b>  <?php endif; ?>  
                           </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                         </select>
                    </div>                                   
                    <button type="submit" class="btn btn-success">SAVE</button>
                  </div>
                <!-- /.col-lg-6 (nested) -->
                <div class="col-lg-6">
                </div>
                <!-- /.col-lg-6 (nested) -->
                <?php echo e(Form::close()); ?>

            </div>
                    <!-- /.row (nested) -->
          </div>
              <!-- /.panel-body -->
      </div>
          <!-- /.panel -->
    </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
</div>
<?php $__env->stopSection(); ?>
      
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>