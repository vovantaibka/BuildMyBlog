<?php $__env->startSection('title', '| Edit Blog Post'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <?php echo Html::style('css/select2.min.css'); ?>


    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: "link code image",
            menubar: false

        });
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <?php echo Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]); ?>

        <div class="col-md-8">
            <?php echo e(Form::label('title', 'Title:')); ?>

            <?php echo e(Form::text('title', null, ["class" => 'form-control input-lg'])); ?>


            <?php echo e(Form::label('slug', 'Slug:', ['class' => 'form-spacing-top'])); ?>

            <?php echo e(Form::text('slug', null, ["class" => 'form-control'])); ?>


            <?php echo e(Form::label('category_id', "Category:", ['class' => 'form-spacing-top'])); ?>

            <?php echo e(Form::select('category_id', $categories, null, ['class' => 'form-control'])); ?>


            <?php echo e(Form::label('tags', 'Tags:', ['class' => 'form-spacing-top'] )); ?>

            <?php echo e(Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple'])); ?>


            <div style="position: relative;">
                <img src="<?php echo e(asset('imgs/' . $image)); ?>" class="form-spacing-top">
                <?php echo e(Form::label('featured_image', 'Image:', ['style' => 'position: absolute; left: 110px; top: 25px'] )); ?>

                <?php echo e(Form::file('featured_image', ['style' => 'position: absolute; left: 110px; top: 50px;'])); ?>

            </div>

            <?php echo e(Form::label('body', "Body:", ['class' => 'form-spacing-top'])); ?>

            <?php echo e(Form::textarea('body', null, ['class' => 'form-control'])); ?>

        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Create At:</dt>
                    <dd><?php echo e(date('M j, Y H:i', strtotime($post->created_at))); ?></dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd><?php echo e(date('M j, Y H:i', strtotime($post->updated_at))); ?></dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')); ?>

                    </div>
                    <div class="col-sm-6">
                        <?php echo e(Form::submit('Save Changes', ['class' => 'btn btn-success btn-block'])); ?>

                    </div>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div><!-- end of .row (form) -->

<?php $__env->startSection('scripts'); ?>

    <?php echo Html::script('js/select2.min.js'); ?>


    <script type="text/javascript">
        $('.select2-multi').select2();
        $('.select2-multi').select2().val(<?php echo json_encode($post->tags()->allRelatedIds()); ?>).trigger('change');
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>