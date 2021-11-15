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


      .disabled{
        background-color: #525252;
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
        cursor: not-allowed;
        color: black;
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

                        <input type="hidden" id="hidRegisterAs" name="registerAs" value="1">

                        <div class="buttonuserchosen">
                            <button class="userchosen_button" name="btnFoundation" style="color: white"> Register as Foundation </button>

                            <button class="userchosen_button d-none" name="btnUser" style="color: white"> Register as User </button>
                        </div>

                        <div class="form-group row">
                            <div class="" id="headReqAs" style="font-size: 150%">
                                Now You're Register As User
                            </div>
                        </div>

                        <br>

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
                            <label for="phoneNumber" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phoneNumber" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber" value="{{ old('phoneNumber') }}" required autocomplete="phoneNumber" autofocus>

                                @error('phoneNumber')
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
                                <button id="btnRegister" disabled type="submit" class="disabled" style="color: white">
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".userchosen_button").on('click', function () {
                event.preventDefault();

                $(".userchosen_button").removeClass("d-none");
                var regAs;

                if($(this).prop("name").includes("User")) regAs = "1";
                else regAs = "2";

                if(regAs == "1") $("#headReqAs").html("Now You're Register As User");
                else if(regAs == "2")
                $("#headReqAs").html("Now You're Register As Foundation");

                $(this).addClass("d-none");
                $("#hidRegisterAs").val(regAs);
            });

            $("#checkbox").on("click", function () {
                if($(this).prop("checked")){
                    $("#btnRegister").removeClass("disabled").addClass("userchosen_button");
                    $("#btnRegister").prop("disabled",false);
                }
                else{
                    $("#btnRegister").removeClass("userchosen_button").addClass("disabled");
                    $("#btnRegister").prop("disabled",true);
                }
            });
        });
    </script>
@endsection