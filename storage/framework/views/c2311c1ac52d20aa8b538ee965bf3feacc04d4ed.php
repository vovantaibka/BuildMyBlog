<?php $__env->startSection('title', '| About'); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/about-contact.css')); ?>"/>
    <div id="about">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Về chủ nhân của trang Blog này</h1>
                <p>Là một đứa sinh viên Bách Khoa HN năm 3. Tự cảm thấy bản thân phù hợp với nghề lập trình hơn bất cứ
                    thứ
                    gì khác. Suốt ngày chỉ cắm đầu bên chiếc laptop. Sống khá khép kín hay mọi người thường bảo là tự
                    kỷ.
                    Blog này là thành quả đầu tiên của tôi khi học lập trình Web. Là một thứ gì đó khiến cho cuộc sống
                    của
                    lập trình viên đỡ tẻ nhạt hơn. Là nơi tôi chia sẻ kinh nghiệm, suy nghĩ cũng như những thứ tôi trân
                    trọng.</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>