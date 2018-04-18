<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 nav-admin">
  <div class="profile-img">
    <a href="/">
      <img src="<?php echo e(Auth::user()->image); ?>" class="" alt="Profile Image">
    </a>
  </div>
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo e(route('admin.main', 'home')); ?>"><?php echo e(Auth::user()->name); ?></a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="<?php echo e(route('logout')); ?>"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
      style="display: none;">
      <?php echo e(csrf_field()); ?>

    </form>
  </li>
</ul>
</nav>