<?php $__env->startSection('title', '| Zoom Image'); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php echo Html::style('css/test.css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h3>Thumbnail Images</h3>
<ul class="list-inline gallery">    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/1"></li>    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/2"></li>    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/3"></li>    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/4"></li>  
</ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>