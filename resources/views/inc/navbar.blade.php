<nav id="navigation">
    <div>
        <img src="https://notify.express/assets/img/express.png" alt="Notify Express Logo">
    </div>
    <ul>
        @if (Auth::check())
            
            @if (Auth::user()->role == 'admin')
                @if (Request::is('admin') || Request::is('admin/*'))
                    <li><a href="admin/search">search</a></li>
                @else
                    <li><a href="admin">admin</a></li>
                @endif
            @endif
            
            <li><a href="discord">Discord</a></li>
            <li><a href="account">My Account</a></li>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li><button type="submit">Logout</button></li>
            </form>
        @else
            <li><a href="login">Login</a></li>
        @endif
    </ul>
</nav>