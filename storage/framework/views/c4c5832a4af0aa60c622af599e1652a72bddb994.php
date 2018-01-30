<?php $__env->startSection('admin-stylesheets'); ?>
<?php echo Html::style('css/parsley.css'); ?>

<?php echo Html::style('css/select2.min.css'); ?>


<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er'></script>

<script>
	tinymce.init({
		selector: 'textarea',
		plugins: "link code image",
		menubar: false

	});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<input id="object" type="hidden" name="object" value="<?php echo e($object); ?>">
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"></main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('js/admin/ajax-load-data.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>