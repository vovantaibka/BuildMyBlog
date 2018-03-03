<nav class="navbar navbar-inverse" id="navbar">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav nav-tabs navbar-nav" id="menu-list">
            <li class="{{ Request::is('/') ? "active" : "" }}"><a href="/"><strong>My Home</strong><span
                class="sr-only">(current)</span></a></li>
                <li class="{{ Request::is('blog') ? "active" : "" }}"><a href="/blog"><strong>Blog</strong></a></li>
                <li role="presentation" class="dropdown {{ Request::is('listenandread') ? "active" : "" }}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <strong>Learn English</strong><span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="/listenandread"><strong>Listen & Read</strong></a></li>
                </ul>
            </li>
            <li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about"><strong>About</strong></a></li>
            <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact"><strong>Contact</strong></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">Hello {{ Auth::user()->name }}<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    {{--<li><a href="{{ route('tags.index') }}">Tags</a></li>--}}
                    {{--<li><a href="{{ route('posts.index') }}">Posts</a></li>--}}
                    {{--<li><a href="{{ route('categories.index') }}">Categories</a></li>--}}
                    <li><a href="{{ route('admin.show', 'home') }}">Management</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('account.edit', Auth::user()->id) }}">Account Info</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
    @else

    <li><a href="{{ route('login') }}">Login</a></li>
    <li><a href="{{ route('register') }}">Register</a></li>

    @endif
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->

<script type="text/javascript">
    $(function() {
        $("li.dropdown").click(function() {
            $("#menu-list").find("li").removeClass("active");
        })
    })
</script>

</nav>