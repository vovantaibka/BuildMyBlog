<?php $__env->startSection('title', '| Blog'); ?>

<?php $__env->startSection('content'); ?>

    <div id="blog">
        <div class="row">
            <div class="col-md-8">
                <h1 style="text-indent: 20px;">Blog</h1>
            </div>
        </div>

        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-md-8">
                    <h2><?php echo e($post->title); ?></h2>
                    <h5>Published: <?php echo e(date('M j, Y', strtotime($post->created_at))); ?></h5>

                    <p><?php echo e(substr(strip_tags($post->body), 0, 250)); ?><?php echo e(strlen(strip_tags($post->body)) > 250 ? "..." : ""); ?></p>

                    <a href="<?php echo e(route('blog.single', $post->slug)); ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <?php echo $posts->links(); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>