<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            BanSkuy
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">{{ __('Let\'s Donate!') }}</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ __('Check Your Progress Here!') }}</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="">{{ __('Forum') }}</a>
                </li>
                <!-- Authentication Links -->
                @guest
                    @if (!Request::is('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login Now') }}</a>
                        </li>
                    @endif

                    @if (Request::is('index'))
                        <li class="nav-item">
                            <a class="nav-link text-white py-1 px-3" style="background-color: #AC8FFF; border-radius: 10%" href="{{ route('login') }}">{{ __('Login Now') }}</a>
                        </li>
                    @endif

                    @if (Request::is('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register Now') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            {{-- {{ Auth::user()->name }} --}}
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-1 px-3" style="background-color: #AC8FFF; border-radius: 10%"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
