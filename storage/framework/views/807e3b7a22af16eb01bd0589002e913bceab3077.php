<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title>My Blog <?php echo $__env->yieldContent('title'); ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- JQuery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

	<?php echo Html::style('css/parsley.css'); ?>

	<?php echo Html::style('css/select2.min.css'); ?>

	<?php echo Html::style('css/admin-styles.css'); ?>


	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er'></script>

	<!-- Scripts -->
	<script>
	    window.Laravel = <?php echo json_encode([
	        'csrfToken' => csrf_token(),
	    ]); ?>;
	</script>
</head>

<body>
	<?php echo $__env->make('admin.partials._nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('modals.confirm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div id="wrapper">
		<?php echo $__env->make('partials._messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="container-fluid">
			<div class="row" id="admin-app">
				<?php echo $__env->yieldContent('content'); ?>
			</div>
		</div>
	</div>
	
	<div id="scripts">
		<?php echo $__env->make('admin.partials._javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->yieldContent('scripts'); ?>
	</div>

	<!-- Script -->
	<script>
		var baseUrl = '<?php echo e(url('/')); ?>';
        var apiUrl = '<?php echo e(url('/api')); ?>';
        var userId = <?php echo e(Auth::user() ? Auth::user()->id : 'null'); ?>;
	</script>
	<script src="<?php echo e(asset('js/admin-app.js')); ?>"></script>
</body>
</html>