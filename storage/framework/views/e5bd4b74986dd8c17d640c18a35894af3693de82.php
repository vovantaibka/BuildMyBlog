

<?php $__env->startSection('title', "| $category->name Category"); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-8">
            <h1>Category: <?php echo e($category->name); ?></h1>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('categories.edit', $category->id)); ?>" class="btn btn-primary pull-right btn-block"
               style="margin-top: 20px;">Edit</a>
        </div>
        <div class="col-md-2">
            <?php echo e(Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE'])); ?>


            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'style' => 'margin-top:20px'])); ?>


            <?php echo e(Form::close()); ?>

        </div>
        
            
                
                    
                    
                        
                        
                        
                        
                    
                    

                    
                    
                        
                            
                            
                            
                                
                                    
                                
                            
                            
                            
                        
                    
                    
                
            
        
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>