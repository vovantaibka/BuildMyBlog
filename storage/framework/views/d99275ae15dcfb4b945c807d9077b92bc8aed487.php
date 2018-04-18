<?php $__env->startSection('title', '| Listen And Read'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
	<div id="listenandread">
		<div class="row">
			<div class="col-md-8">
				<h2>Listen & Read</h2>
				<ul class="nav nav-pills">
					<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li role="presentation">
						<a href="/listenandread/category/<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></a>
					</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
				<hr>
				<ul class="media-list">
					<?php if(count($audios) > 0): ?>
						<?php $__currentLoopData = $audios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="media">
							<a href="">
								<img src="<?php echo e(asset('imgs/' . $audio->image)); ?>">
							</a>
							<aside>
								<h3>
									<a href=""><?php echo e($audio->title); ?></a>
								</h3>
								<time>Poster: <?php echo e($audio->created_at); ?></time>
								<p><?php echo e($audio->introduce); ?></p>
							</aside>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>