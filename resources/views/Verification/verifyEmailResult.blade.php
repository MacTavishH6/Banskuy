@extends('layouts.app')

@section('content')

    <style>


        .btn{
          border-radius:21px;

        }

        .container{
            width:100%
        }
        
        .card-header{
            max-height: 70px;
        }

        a.PostTitle:hover, a.PostTitle:active {font-size: 110%;}
    </style>

    
    {{-- Script End Here --}}
<div style="text-align: center">
    <div style="margin-left:30%;margin-bottom:20%;max-width:40%;margin-top:5%" class=" p-2 border border-primary rounded ">
        Terimakasih sudah melakukan verifikasi email,
        silahkan login untuk mengakses fitur fitur Banskuy
    
        <br>
        <div style="text-align: left">
        Salam Hangat<br>
        Tim Banskuy<br>
        </div>
    
       </div>
</div>
  
    
    


    
@endsection
