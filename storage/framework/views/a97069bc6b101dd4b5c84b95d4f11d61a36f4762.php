<?php $__env->startSection('title', '| Homepage'); ?>

<?php $__env->startSection('content'); ?>
<div id="welcome">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/freestyle.css')); ?>"/>
    <div class="row" id="introduce">
        <div class="welcome-blog">
            <img src="<?php echo e(asset('imgs/man-sitting-near-large-body-of-water-under-clear-sky-during-sunset-164293.jpeg')); ?>" class="img-responsive img-thumbnail"
                alt="Welcome image">
        </div>
    </div> <!-- end of header .row -->

    <div class="row" id="posts">
        <div class="col-md-8 col-md-offset-2">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row post">
                <div class="col-md-6 image">
                    <img src="<?php echo e(asset('imgs/' . $post->image)); ?>">
                </div>
                <div class="col-md-6 summary">
                    <div class="author">
                        <div class="avatar">
                            <a href="#">
                                <img src="<?php echo e(asset('imgs/Admin.png')); ?>" class="" alt="Profile Image">
                            </a>
                        </div>
                        <div class="info">
                            <span class="name">
                                <span><?php echo e($post->user->name); ?></span>
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path d="M15.94,10.179l-2.437-0.325l1.62-7.379c0.047-0.235-0.132-0.458-0.372-0.458H5.25c-0.241,0-0.42,0.223-0.373,0.458l1.634,7.376L4.06,10.179c-0.312,0.041-0.446,0.425-0.214,0.649l2.864,2.759l-0.724,3.947c-0.058,0.315,0.277,0.554,0.559,0.401l3.457-1.916l3.456,1.916c-0.419-0.238,0.56,0.439,0.56-0.401l-0.725-3.947l2.863-2.759C16.388,10.604,16.254,10.22,15.94,10.179M10.381,2.778h3.902l-1.536,6.977L12.036,9.66l-1.655-3.546V2.778z M5.717,2.778h3.903v3.335L7.965,9.66L7.268,9.753L5.717,2.778zM12.618,13.182c-0.092,0.088-0.134,0.217-0.11,0.343l0.615,3.356l-2.938-1.629c-0.057-0.03-0.122-0.048-0.184-0.048c-0.063,0-0.128,0.018-0.185,0.048l-2.938,1.629l0.616-3.356c0.022-0.126-0.019-0.255-0.11-0.343l-2.441-2.354l3.329-0.441c0.128-0.017,0.24-0.099,0.295-0.215l1.435-3.073l1.435,3.073c0.055,0.116,0.167,0.198,0.294,0.215l3.329,0.441L12.618,13.182z"></path>
                                </svg>
                            </span>
                            <div class="time">
                                <span><?php echo e(Carbon\Carbon::parse($post->updated_at)->format('d-m-Y')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <a href="<?php echo e(url('blog/' . $post->slug)); ?>"><h3 class="title"><?php echo e(substr($post->title, 0, 70)); ?><?php echo e(strlen($post->title) >= 70 ? "..." : ""); ?></h3></a>
                        <span><?php echo e(substr(strip_tags($post->body), 0, 350)); ?><?php echo e(strlen(strip_tags($post->body)) >= 350 ? "..." :""); ?></span>
                    </div>
                    <div class="interactive">
                        <div class="line"></div>
                        <div class="row">
                            <div class="views col-md-4">
                                <span>Views</span>
                            </div>
                            <div class="comment col-md-6">
                                <a href=""><span>Write a comment</span></a>
                            </div>
                            <div class="like col-md-2">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="show-more text-center">
        <button type="button" class="show-more-btn"><a href="/blog">Show More</a></button>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>