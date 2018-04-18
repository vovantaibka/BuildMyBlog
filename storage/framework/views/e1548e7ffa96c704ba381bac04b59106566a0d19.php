<?php $__env->startSection('title', '|HayLam'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php echo Form::open(); ?>


            <?php echo e(Form::label('question', 'Có nên tiếp túc nữa không!!!', array('class' => 'haylam'))); ?>


            <?php echo e(Form::button('Có', array('class' => 'btn btn-success'))); ?>

            <?php echo e(Form::button('Không', array('class' => 'btn btn-danger'))); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>