<?php $__env->startSection('title', '| Homepage'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="styles.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/freestyle.css')); ?>"/>
    <div id="page-home">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-blog" style="margin-top: 20px;  margin-bottom: 30px;">
                    <img src="<?php echo e(asset('imgs/ksenia-makagonova-227168.jpg')); ?>" class="img-responsive img-thumbnail"
                         alt="Welcome image">
                </div>
                
                
                
                
                
                
                
                
                
                
            </div>
        </div> <!-- end of header .row -->

        <div class="row" id="wrapper">
            
                
                    
                        
                            
                        
                    
                    
                        
                            
                                
                            
                        
                    
                
            

            <div class="col-md-8 col-md-offset-1">

                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="post">
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

<?php $__env->startSection('scripts'); ?>
    <script>
        //confirm('I loaded up some JS')
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>