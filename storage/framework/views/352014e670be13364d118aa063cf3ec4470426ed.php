<ul class="media-list">
	<?php if(count($audios) > 0): ?>
	<?php $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li class="media">
		<a href="<?php echo e(route('english.single', $audio->slug)); ?>" class="pull-left">
			<img src="<?php echo e(asset('imgs/' . $audio->image)); ?>" class="media-object">
		</a>
		<aside class="media-body">
			<h3 class="media-heading">
				<a href="<?php echo e(route('english.single', $audio->slug)); ?>"><?php echo e($audio->title); ?></a>
			</h3>
			<time>Poster: <?php echo e(Carbon\Carbon::parse($audio->created_at)->format('d-m-Y')); ?></time>
			<p><?php echo e($audio->introduce); ?></p>
		</aside>
	</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
</ul>