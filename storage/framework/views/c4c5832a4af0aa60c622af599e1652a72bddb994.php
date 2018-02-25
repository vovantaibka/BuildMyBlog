<?php $__env->startSection('content'); ?>
<input id="object" type="hidden" name="object" value="<?php echo e($object); ?>">
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"></main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>