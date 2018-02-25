<?php $__env->startSection('title', "| Tutorial jQuery"); ?>

<?php $__env->startSection('content'); ?>
<p class="intro">Việt Nam vô địch</p>
<p id="lastname">U23 Việt Nam thắng U23 Uzbekistan</p>
<p>Việt Nam tham dự World Cup 2022</p>

<button type="button" class="btn btn-primary">Button</button>

<script type="text/javascript">
	$(function() {
		$("button").click(function() {
			$(".intro, #lastname").css('color', 'red');
		})
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>