<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand m-l-50 row" href="{{ route('index') }}">Note cards</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if (Auth::user())
                <li class="nav-item active m-l-50">
                    <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            @if (!Auth::guest())
                <li class="nav-item dropdown m-r-75">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile', ['user' => Auth::id()]) }}">User
                            profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
