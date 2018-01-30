<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $__env->make('admin.partials._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>

<body>
	<?php echo $__env->make('admin.partials._nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('modals.confirm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div id="wrapper">
		<?php echo $__env->make('partials._messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="container-fluid">
			<div class="row">
				<?php echo $__env->make('admin.partials._sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo $__env->yieldContent('content'); ?>
			</div>
		</div>
	</div>
	
	<?php echo $__env->make('admin.partials._javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>