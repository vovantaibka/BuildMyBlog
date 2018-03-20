<?php $__env->startSection('title', "| Edit Tag"); ?>

<?php $__env->startSection('content'); ?>

    <?php echo e(Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => "PUT"])); ?>


    <?php echo e(Form::label('name', "Title:")); ?>

    <?php echo e(Form::text('name', null, ['class' => 'form-control'])); ?>


    <?php echo e(Form::submit('Save Changes', ['class' => 'btn btn-success', 'style' => 'margin-top:20px;'])); ?>


    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>