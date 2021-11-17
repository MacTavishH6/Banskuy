<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            BanSkuy
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-navbar"
            aria-controls="header-navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="header-navbar">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @if (!Auth::guard('foundations')->check())
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link"
                                href="/makerequest/{{ Crypt::encrypt(Auth::id()) }}">{{ __('Let\'s Donate!') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link"
                                href="/login">{{ __('Let\'s Donate!') }}</a>
                        </li>
                    @endif
                @endif

                @if (Auth::guard('foundations')->check() || Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/donationhistory">{{ __('Check Your Progress Here!') }}</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="">{{ __('Forum') }}</a>
                </li>

                <!-- Authentication Links -->
                @if (Auth::guard('foundations')->check() || Auth::check())
                    <li class="nav-item">
                        @if (Auth::guard('foundations')->check())
                            <a class="nav-link" href="/foundationprofile/{{ Crypt::encrypt(Auth::id()) }}">
                                {{ Auth::guard('foundations')->user()->Username ? Auth::guard('foundations')->user()->Username : Auth::guard('foundations')->user()->Email }}
                                Profile
                            </a>
                        @elseif(Auth::check())
                            <a class="nav-link" href="/profile/{{ Crypt::encrypt(Auth::id()) }}">
                                {{ Auth::user()->Username ? Auth::user()->Username : Auth::user()->Email }}
                                Profile
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-1 px-3"
                            style="background-color: #AC8FFF; border-radius: 20px;" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    @if (!Request::is('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login Now') }}</a>
                        </li>
                    @endif

                    @if (Request::is('index'))
                        <li class="nav-item">
                            <a class="nav-link text-white py-1 px-3"
                                style="background-color: #AC8FFF; border-radius: 20px;"
                                href="{{ route('login') }}">{{ __('Login Now') }}</a>
                        </li>
                    @endif

                    @if (Request::is('login'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('register') }}">{{ __('Register Now') }}</a>
                        </li>
                    @endif

                @endif
        </ul>
    </div>
</div>
</nav>
