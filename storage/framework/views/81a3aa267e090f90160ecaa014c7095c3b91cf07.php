<?php $__env->startSection('content'); ?>
    
    
    <h1>Hello App!</h1>
	  <p>
	    <!-- use router-link component for navigation. -->
	    <!-- specify the link by passing the `to` prop. -->
	    <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
	    <router-link to="/foo">Go to Foo</router-link>
	    <router-link to="/bar">Go to Bar</router-link>
	  </p>
    <router-view></router-view>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>