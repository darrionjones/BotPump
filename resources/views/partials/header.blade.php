<header class="main-header">

    <a href="{{ url('dashboard') }}" class="logo">
        <span class="logo-mini"><img src="{{ asset('img/logoicon.jpg') }}" height="36px"></span>
        <span class="logo-lg"><img src="{{ asset('img/logo-black.jpg') }}" height="36px"></span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (!Auth::user()->avatar)
                        <img src="{{ asset('/img/user-160x160.jpg')}}" class="user-image" alt="User Image">
                        @else
                        <img src="{{ asset('/storage/avatars/' . Auth::user()->avatar . '')}}" class="user-image" alt="User Image">
                        @endif
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <ul class="sidebar-menu">
                            <li><a href="{{ url('apikey') }}"><i class="fa fa-key"></i>Bot Service APIs</a></li>
                            <li><a href="{{ url('exchangekey') }}"><i class="fa fa-key"></i>Exchange APIs</a></li>
                            <li><a href="{{ url('profile') }}"><i class="fa fa-user"></i>Profile Settings</a></li>
                            <hr style="margin:0px;">
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Log Out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>