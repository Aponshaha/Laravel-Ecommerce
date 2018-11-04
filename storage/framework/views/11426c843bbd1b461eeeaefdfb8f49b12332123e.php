<?php $__env->startSection('content'); ?>
<div class="container">   
  <!- Featured Products -->
  <div class="row">
    <div class="col-sm-12 text-center bold-class font-big padding-bottom-big">Featured Products
    </div>
  </div>
  <div class="row">
    <?php if($data['featured_products'] && count($data['featured_products'])): ?>
      <?php $__currentLoopData = $data['featured_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading"><?php echo e($product->product_name); ?></div>
          <div class="panel-body"> 
            <a title="<?php echo e($product->product_name); ?>" href="<?php echo e(url('/')); ?>/product/details/<?php echo e($product->product_row_id); ?>">
              <img src="<?php echo e(asset('/')); ?>uploads/products/<?php echo e($product->product_image); ?>"  alt="product" style="width: 280px; height:180px">
            </a>
            </div>
          <div class="panel-footer">Price: <?php echo e($product->product_price); ?> </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  </div>
  <!- Featured Products -->

  <!- Latest Products -->
  <div class="row">
    <div class="col-sm-12 text-center bold-class font-big padding-bottom-big">Latest Products</div>
  </div>
  <div class="row">
    <?php if($data['latest_products'] && count($data['latest_products'])): ?>
      <?php $__currentLoopData = $data['latest_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading"><?php echo e($product->product_name); ?></div>
          <div class="panel-body"> 
            <a title="<?php echo e($product->product_name); ?>" href="<?php echo e(url('/')); ?>/product/details/<?php echo e($product->product_row_id); ?>">
              <img src="<?php echo e(asset('/')); ?>uploads/products/<?php echo e($product->product_image); ?>"  alt="product" style="width: 225px;height:225px">
            </a>
            </div>
          <div class="panel-footer">Price: <?php echo e($product->product_price); ?> </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  </div>
  <!- Latest Products -->

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>