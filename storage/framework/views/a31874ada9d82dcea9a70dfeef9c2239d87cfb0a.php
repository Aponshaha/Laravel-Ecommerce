<?php $__env->startSection('content'); ?>
<div class="container">
	<h3 class="text-center" style="padding-top: 10px"> 
	<p style="color:green;">Thank you, Your order has been placed successfully.</p>
	Your order no is: ORD-<?php echo e($data['order_no']); ?></h3>
	<div class="thank text-center" style="padding:50px 0px 20px 0;font-weight: bold;font-size:10px">
		We Are Feeling Lucky To Have You.
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>