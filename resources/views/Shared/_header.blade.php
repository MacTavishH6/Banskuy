<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ env('FTP_URL') }}assets/LogoBanskuy.png" alt="" srcset="" style="width: 180px;">
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
                @if (!Auth::guard('admin')->check())
                    @if (!Auth::guard('foundations')->check())
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="/makerequest/{{ Crypt::encrypt(Auth::id()) }}">{{ __('Ayo berdonasi!') }}</a>
                            </li>
                        @else
                            @if (!str_contains($_SERVER['HTTP_HOST'], 'foundation.'))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('login') }}">{{ __('Ayo berdonasi!') }}</a>
                                </li>
                            @endif
                        @endif
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/usersearching">{{ __('Lihat pengguna terlapor') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/postsearching">{{ __('Lihat post terlapor') }}</a>
                    </li>
                @endif

                @if (!Auth::guard('admin')->check())
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/donationhistory">{{ __('Check Progress Anda di sini!') }}</a>
                    </li>
                @elseif(Auth::guard('foundations')->check())
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/donationapproval">{{ __('Check Progress Anda di sini!') }}</a>
                    </li>
                @endif
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/Forum">{{ __('Forum') }}</a>
                </li>

                <!-- Authentication Links -->
                @if (Auth::guard('foundations')->check() || Auth::check() || Auth::guard('admin')->check())
                    <li class="nav-item">
                        @if (!Auth::guard('admin')->check())
                        @if (Auth::guard('foundations')->check())
                            <a class="nav-link"
                                href="/foundationprofile/{{ Crypt::encrypt(Auth::guard('foundations')->id()) }}">
                                {{ Auth::guard('foundations')->user()->Username ? Auth::guard('foundations')->user()->Username : Auth::guard('foundations')->user()->Email }}
                                Profil
                            </a>
                        @elseif(Auth::check())
                            <a class="nav-link" href="/profile/{{ Crypt::encrypt(Auth::id()) }}">
                                {{ Auth::user()->Username ? Auth::user()->Username : Auth::user()->Email }}
                                Profil
                            </a>
                        @endif
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-1 px-3" style="background-color: #AC8FFF; border-radius: 20px;"
                            href="{{ '/logout' }}"
                            onclick="event.preventDefault();
                                                                                    document.getElementById('logout-form').submit();">
                            {{ __('Keluar') }}
                        </a>

                        <form id="logout-form" action="{{ '/logout' }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    @if (!Request::is('login') && !Request::is('foundationlogin'))
                        @if (str_contains($_SERVER['HTTP_HOST'], 'donate.'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                            </li>
                        @elseif(str_contains($_SERVER['HTTP_HOST'],'foundation.'))
                            <li class="nav-item">
                                <a class="nav-link" href="/foundationlogin">{{ __('Masuk') }}</a>
                            </li>
                        @elseif(str_contains($_SERVER['HTTP_HOST'],'admin.'))
                            <li class="nav-item">
                                <a class="nav-link" href="/login">{{ __('Masuk') }}</a>
                            </li>

                        @endif
                    @endif

                    @if (Request::is('index'))
                        @if (str_contains($_SERVER['HTTP_HOST'], 'donate.'))
                            <li class="nav-item">
                                <a class="nav-link text-white py-1 px-3"
                                    style="background-color: #AC8FFF; border-radius: 20px;"
                                    href="{{ route('login') }}">{{ __('Masuk') }}</a>
                            </li>
                        @elseif(str_contains($_SERVER['HTTP_HOST'],'foundation.'))
                            <li class="nav-item">
                                <a class="nav-link text-white py-1 px-3"
                                    style="background-color: #AC8FFF; border-radius: 20px;"
                                    href="/foundationlogin">{{ __('Masuk') }}</a>
                            </li>
                        @elseif(str_contains($_SERVER['HTTP_HOST'],'admin.'))
                            <li class="nav-item">
                                <a class="nav-link text-white py-1 px-3"
                                    style="background-color: #AC8FFF; border-radius: 20px;"
                                    href="/login">{{ __('Masuk') }}</a>
                            </li>
                        @endif
                    @endif

                    @if ((Request::is('login') || Request::is('foundationlogin')) && !str_contains($_SERVER['HTTP_HOST'], 'admin.'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ Request::is('login') ? route('register') : '/foundationregister' }}">{{ __('Daftar Sekarang') }}</a>
                        </li>
                    @endif

                @endif
            </ul>
        </div>
    </div>
</nav>
