<?php $__env->startSection('title', '| Listen And Read'); ?>

<?php $__env->startSection('content'); ?>
<div id="media-single" class="container">
	<div class="row">
		<div class="col-md-9">
			<article class="program">
				<header>
					<h2><?php echo e($audio->title); ?></h2>
					<time><?php echo e(Carbon\Carbon::parse($audio->created_at)->format('d-m-Y')); ?></time>
				</header>
				<hr>
				<div class="row">
					<div class="col-md-6">
							
								
									
								
							
						<div id="audio-player">
							<video src="<?php echo e($audio->linkOpen); ?>" loop="loop" poster="<?php echo e(asset('imgs/' . $audio->image)); ?>" width="332px" controls>
								<p>Your browser cannot play this video. You might try to 
									<a href="video/getting_a_book.mp4">download it</a>.
								</p> 
							</video>
						</div>
					</div>
					<div></div>
					<div class="col-md-6">
						<div class="program-description">
							<div class="well well-lg">
								<p><?php echo e($audio->introduce); ?></p>
							</div>
						</div>
						<div class="program-buttons row">
							<div class="col-xs-6">
								<a href="<?php echo e($audio->linkDownload); ?>">
									<button type="button" class="btn btn-primary btn-lg btn-block">
										<span class="glyphicon glyphicon-headphones"></span>
										Audio
									</button>
								</a>
							</div>
							<div class="col-xs-6">
								<a href="#transcript" class="btn btn-primary btn-lg btn-block">
									<span class="glyphicon glyphicon-file"></span>
									Transcript
								</a>
							</div>
						</div>
					</div>
				</div>
				<div id="transcript">
					<h3>Transcript</h3>
					<hr>
				</div>
			</article>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>