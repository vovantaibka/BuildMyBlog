<?php $__env->startSection('title', '| Listen And Read'); ?>

<?php $__env->startSection('content'); ?>
<div id="listen-read" class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>Listen & Read</h2>
			<ul class="nav nav-pills">
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li role="presentation">
					<input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">
					<a href="#"><?php echo e($category->name); ?></a>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
			<hr>
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
		</div>
	</div>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
	<script src="<?php echo e(asset('js/english.js')); ?>"></script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>