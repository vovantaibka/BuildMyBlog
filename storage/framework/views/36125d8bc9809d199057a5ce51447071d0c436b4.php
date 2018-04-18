<!DOCTYPE html>
<html>
<head>
	<!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title>Router VueJS</title>

	<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body>
    <div id="app">
        <h1>Hello App!</h1>
        <p>
            <router-link to="/foo">Go to Foo</router-link>
            <router-link to="/bar">Go to Bar</router-link>
        </p>
        <router-view></router-view>
    </div>
	<script src="<?php echo e(asset('js/router-vue.js')); ?>"></script>
</body>
</html>