<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('partials._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>

<body>
<?php echo $__env->yieldContent('process'); ?>

<div id="wrapper">
    <?php echo $__env->make('partials._messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div id="app">
    	<?php echo $__env->yieldContent('content'); ?>
	</div>

    <div id="footer">
        <?php echo $__env->make('partials._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div><!-- end of .container -->

<div id="scripts">
	<?php echo $__env->make('partials._javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->yieldContent('scripts'); ?>
</div>

<!-- Script -->
<script type="text/javascript">
	var baseUrl = '<?php echo e(url('/')); ?>';
    var imgsUrl = '<?php echo e(url('/imgs')); ?>';
</script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>