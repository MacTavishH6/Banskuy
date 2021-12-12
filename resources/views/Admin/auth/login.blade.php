@extends('layouts.app')

@section('content')

    <style>
        .titlejoin {
            text-align: center;
            font-size: 250%;
        }

        .login_button {
            background-color: #9F51CF;
            text-align: center;
            border: none;
            border-radius: 21px;
            font-family: "Raleway SemiBold", sans-serif;
            height: 42.3px;
            margin: 0 auto;
            transition: 0.25s;
            width: 153px;
            box-shadow: 0px 1px 8px rgb(153, 121, 39);
            margin-bottom: 10px;
            cursor: pointer;
            color: black;
        }

        .login_button:hover {
            background-color: #45C1A4;
            box-shadow: 0px 0px 20px rgb(255, 255, 255);
        }

        .buttonlogin {
            text-align: center;
        }

        .forgotpassword {
            text-align: center;
        }

        .donthaveanaccount {
            margin-top: 5%;
            text-align: center;
        }

    </style>

    <div style="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="titlecontainer">
                            <div class="titlejoin"><img src="{{ env('FTP_URL') }}assets/LogoBanskuy.png" alt=""
                                    srcset=""></div>
                            <div class="titlejoin">{{ __('Yang lain menunggu anda !') }}</div>
                        </div>

                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger" style="margin-top: 20px">
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (session('failed'))
                            <div class="alert alert-danger mt-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('failed') }}
                            </div>
                        @elseif(session('status'))
                            <div class="alert alert-success mt-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="card-body">
                            <form method="POST" action="/adminlogin">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text"
                                            class="form-control @error('email') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <br>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Ingat Saya') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="buttonlogin form-group row mb-0">
                                    {{-- <div class="col-md-8 offset-md-4"> --}}
                                    <button type="submit" class="login_button" style="color: white">
                                        {{ __('Masuk') }}
                                    </button>
                                    {{-- </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
