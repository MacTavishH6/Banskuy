@extends('layouts.app')

@section('content')

<style>
    .alreadyhaveanaccount{
        margin-top: 5%;
        text-align: center;
    }

    .checkboxloginpage{
        text-align: center;
    }

    .titlejoin{
        text-align: center;
        font-size: 250%;
    }

    .register_button {
        background-color: #AC8FFF;
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
      .register_button:hover {
        box-shadow: 0px 5px 20px rgb(153, 121, 39);
      }
      .buttonregister{
          text-align: center;
      }
      .userchosen_button{
        background-color: #AC8FFF;
        text-align: center;
        border: none;
        border-radius: 21px;
        font-family: "Raleway SemiBold", sans-serif;
        height: 42.3px;
        margin: 0 auto;
        transition: 0.25s;
        width: 170px;
        box-shadow: 0px 1px 8px rgb(153, 121, 39);
        margin-bottom: 10px;
        cursor: pointer;
        color: black;
      }
      .userchosen_button:hover{
        box-shadow: 0px 5px 20px rgb(153, 121, 39);
      }
      .buttonuserchosen{
        text-align: right;
        margin-bottom: 2%;
      }
/*
    .logincontainer {
        
        yg height masih pake px pixel belum responsive
        
        background: #fbfbfb;
        border-radius: 30px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 500px;
        margin: 6rem auto 8.1rem auto;
        width: 400px;
    }

    a{
        text-decoration: none;
    }
*/
    
</style>



<div class="logincontainer container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="titlecontainer">
                    <div class="titlejoin">{{ __('Logo BanSkuy') }}</div>
                    <div class="titlejoin">{{ __('Join The Others !') }}</div>        
                </div>
                
                
                
                

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="buttonuserchosen">
                            <input type="submit" class="userchosen_button" name="submit" style="color: white" value="Register as Foundation">
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <br>

                        <div class="form-group row">
                            <label for="PhoneNumber" class="col-md-4 col-form-label text-md-right">{{ __('PhoneNumber') }}</label>

                            <div class="col-md-6">
                                <input id="PhoneNumber" type="text" class="form-control @error('PhoneNumber') is-invalid @enderror" name="PhoneNumber" value="{{ old('PhoneNumber') }}" required autocomplete="PhoneNumber" autofocus>

                                @error('PhoneNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="checkboxloginpage">
                            <input type="checkbox" id="checkbox" name="checkbox" value="checkbox">
                            <label for="checkbox"> By checking this, you agree to our</label>
                            <a href="">terms and condition !</a>
                        </div>

                        <br>

                        {{-- BUTTON REGISTER BAWAAN BOOTSTRAP --}}
                        <div class="buttonregister form-group row mb-0">
                            {{-- <div class="col-md-6 offset-md-4"> --}}
                                <button type="submit" class="register_button" style="color: white">
                                    {{ __('Register') }}
                                </button>
                            {{-- </div> --}}
                        </div>

                        <div class="alreadyhaveanaccount">
                            <p>
                                Already Have An Account? <a href="{{ route('login') }}">Login Now!</a>
                            </p>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
