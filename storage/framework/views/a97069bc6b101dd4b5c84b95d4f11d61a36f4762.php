<?php $__env->startSection('title', '| Homepage'); ?>

<?php $__env->startSection('content'); ?>
<div id="welcome">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/freestyle.css')); ?>"/>
    <div class="row" id="introduce">
        <div class="col-md-12">
            <div class="welcome-blog">
                <img src="<?php echo e(asset('imgs/ksenia-makagonova-227168.jpg')); ?>" class="img-responsive img-thumbnail"
                alt="Welcome image">
                <p style="margin-top: 10px">   ❝Thời trẻ dại, chúng mình thường hỏi nhau sẽ chọn cuộc đời bình lặng hay bão
                    giông. Hồi đấy mình bảo mình sẽ chọn bão giông. Vì phải trải qua thử thách con người mới khôn lớn,
                    trưởng thành được. Cuộc sống dễ dàng quá sẽ làm người ta yếu ớt đi. Giờ nghĩ lại, có khi mình sẽ
                chọn bình yên. Vì cuộc đời, chẳng cần chọn, cũng vẫn đầy giông bão mà thôi...❞</p>
            </div>
        </div>
    </div> <!-- end of header .row -->

    <div class="row" id="posts">
        <div class="col-md-8 col-md-offset-1">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="post">
                <img src="<?php echo e(asset('imgs/' . $post->image)); ?>">
                <h3><?php echo e($post->title); ?></h3>
                <p><?php echo e(substr(strip_tags($post->body), 0, 300)); ?><?php echo e(strlen(strip_tags($post->body)) >= 300 ? "..." :""); ?></p>
                <a href="<?php echo e(url('blog/' . $post->slug)); ?>" class="btn btn-primary">Đọc thêm</a>
            </div>
            <hr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>