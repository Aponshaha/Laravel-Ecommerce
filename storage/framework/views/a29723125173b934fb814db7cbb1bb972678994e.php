<?php $__env->startSection('content'); ?>
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Product
                        </div>
                        <div class="panel-body">
                            <div class="row">                             
                            <?php echo e(Form::open(array('url' => 'admin/product/update', 'files' => true))); ?>    
                            <input type="hidden" name="hidden_row_id" value="<?php echo e($data['single_info']->product_row_id); ?>">                         
                                <div class="col-lg-6">                                    
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input class="form-control" required="required" id="product_name" name="product_name" value="<?php echo e($data['single_info']->product_name); ?>">
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Product Sku</label>
                                        <input class="form-control" name="product_sku" id="product_sku" value="<?php echo e($data['single_info']->product_sku); ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label>Product Price</label>
                                         <input class="form-control" name="product_price" id="product_price" value="<?php echo e($data['single_info']->product_price); ?>" placeholder="Price">
                                    </div>

                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <input type="file" id="image1" name="product_image">
                                    </div>  
                                    <div class = "form-group">
                                      <label for="exampleInputEmail1">Product Name</label>       
                                      <div id ="image1_holder" >                       
                                         <?php if( $data['single_info']->product_image): ?>
                                         <img src="<?php echo e(url('/uploads')); ?>/products/<?php echo e($data['single_info']->product_image); ?>" style="height:100px;width:100px" alt="produt image" />
                                         <a href="javascript:void(0)" image1_name="<?php echo e($data['single_info']->product_image); ?>" delete_row_id="<?php echo e($data['single_info']->product_row_id); ?>" id="image1_delete"><img src="<?php echo e(url('/')); ?>/images/delete.png"  alt="Delete"/></a>
                                         <?php endif; ?>
                                      </div>
                                    </div> 

                                   
                                    <button type="submit" class="btn btn-success">SAVE</button>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                  <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" name="product_long_description" rows="3"><?php echo e($data['single_info']->product_long_description); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="is_latest" name="is_latest" <?php if( $data['single_info']->is_latest == 1): ?> checked="checked" <?php endif; ?>>Is it Special Product ?
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  id="is_featured" name="is_featured"  <?php if( $data['single_info']->is_featured == 1): ?> checked="checked" <?php endif; ?> >Is it Featured Product ?
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_row_id" class = "form-control" required="required">
                                              <option value="" <?php if( $data['single_info']->category_row_id == ""): ?> selected="selected" <?php endif; ?> >Select</option>         
                                              <?php $__currentLoopData = $data['categories_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->category_row_id); ?>"  <?php if( $data['single_info']->category_row_id == $row->category_row_id): ?> selected="selected" <?php endif; ?>>
                                                <?php if($row->level == 0): ?> <b>  <?php endif; ?>  
                                                <?php if($row->level == 1): ?> &nbsp; - <?php endif; ?> 
                                                <?php if($row->level == 2): ?> &nbsp; &nbsp; &nbsp;  - <?php endif; ?>            
                                                <?php echo e($row->category_name); ?> 
                                                <?php if($row->level == 0): ?> </b>  <?php endif; ?>  
                                                </option>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
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

<?php $__env->startSection('page_level_js'); ?>
<script type="text/javascript">
  $('#image1').bind('change',setImage);
    function setImage(event) {    
        var files = event.target.files;
        var fileName = files[0].name;
        var tmpPath = URL.createObjectURL(event.target.files[0]);
        $('#image1_holder') . html('');
        $('#image1_holder') . html('<img src = "' + tmpPath + '" alt="Image" style="height:100px;" />');
    }    
    
    
    $('#image1_delete') . click( function() 
    {
    if( !confirm('Are you sure you want to delete ?'))
    return false;
    
    var id  = $(this).attr('delete_row_id');
    var file_name  = $(this).attr('image1_name');    
    $('#image1_holder') . html('');
    $.ajax({
        type: "GET",
        url : "<?php echo e(url ('/')); ?>" + "/admin/product/deleteImageOnly/" + id + "/" + file_name ,                         
        success : function(status){
         $('#image1_holder') . html('<span class="inline_success_message">Image has been deleted</span>');
         $('#image1_holder').delay(3000).fadeOut('slow', function(){
             $('#image1_holder').html('');    
             $('#image1_holder').fadeIn('slow');    
         });
         
        }
    });
    }); 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>