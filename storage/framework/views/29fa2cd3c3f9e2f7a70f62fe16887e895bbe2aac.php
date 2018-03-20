<?php $__env->startSection('title', '| Js with Laravel'); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form action="">
                <p>Em có yêu anh <input type="text" value="Francy" id="your-name"> không?</p>
                <input type="submit"
                       onclick="show_result_yes()"
                       value="Chắc chắn có rồi"
                       id="yes">

                <input type="submit"
                       onmouseover="show_result_no()"
                       value="Không bao giờ"
                       id="no">
            </form>

        </div>
    </div>

    <script language="JavaScript">

        var yourName = document.getElementById('your-name');

        yourName.addEventListener('mouseover', function(){
//            alert('Nhập tên của anh vào đây');
//            document.write('Enter your name');

                console.log(yourName);

        });



        function show_result_yes() {
            alert('Anh biết mà! Ahihi');
        }

        function show_result_no() {
            alert('Bạn không muốn, buồn quá đi à???')
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>