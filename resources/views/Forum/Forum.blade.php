@extends('layouts.app')

@section('content')

    {{-- css style start here --}}
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

    {{-- css style end here --}}

    {{-- Script Start Here --}}
    <script>
        $( document ).ready(function() {
            $(".custom-file-input").on("change",function(){
               
            var FileUpload = $('#fuAttachment').val().split('\\').pop();
            console.log(FileUpload)
                $(this).siblings(".custom-file-label").addClass("selected").html(FileUpload);
             });

             
             $("#txaPostDesc").on("change keyup paste",function(){
               
                var TextLength = $('#txaPostDesc').val().length;
                
                $('#lblDescLenght').text(TextLength + "/255");
             });

             if({{$AllowedPost}} == 0){
                 $('#mdlAlert').modal();
             }
        });
    </script>

<script>
    function ChangeDonationTypeDetail(val) {
        $.ajax({
                url: '/GetDonationCategoryDetail/' + val.value,
                type : 'get',
                dataType : 'json',
                success : 
                function(response){
                    var Lenght = 0;
                    if(response['Data'] != null){
                        $('#ddlDonationTypeDetail').empty();
                        for(var i = 0; i < response['Data'].length ; i++){
                            var Value = response['Data'][i].DonationTypeDetailID;
                            var Name = response['Data'][i].DonationTypeDetail;
                            $('#ddlDonationTypeDetail').append('<option value ='+Value+'>'+Name+'</option>');
                        }
                    }
                }
        });
    }

    function btnShowPostOnClick($id){
            var Name = '#Collapse' + $id;

            if($(Name).css('display') == 'none'){
                $(Name).css("display","block");
            }
            else{
                $(Name).css("display","none");
            }
        }

    </script>
    
    {{-- Script End Here --}}

<div class="container" >

        {{-- SLIDER START HERE --}}
        <div class="slider" style="margin-left:20%" >
            @include('Shared.Slider')
        </div>
        {{-- SLIDER END HERE --}}

        {{-- LIST POST START HERE --}}
        <div class="PagePost">
            <div class="d-flex flex-row-reverse bd-highlight w-100 mb-3">
                <div class="p-2">
                    {{-- @if (true) --}}
                    @if ($AllowedPost == 1)
                    <button type="button" class="btn btn-info px-2 pt-2" data-toggle="modal"
                        data-target="#mdlMakePost" >
                        <h6>Buat post</h6>
                    </button>
                    @elseif(Auth::guard('foundations')->check())
                    <p style="color: red">*Harap lengkapi dokumen di menu profile sebelum membuat post</p>
                    @endif
                </div>
            </div>

            
  
                @foreach ($DonationType as $ItemType)
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-header" id="heading{{$ItemType->DonationTypeID}}" >
                                    <div class="d-flex">
                                        <div class="mr-auto p-2">
                                            <a href="/Forum/{{$ItemType->DonationTypeID}}" style="text-decoration: none"><h4>{{$ItemType->DonationTypeName}}</h4></a>
                                        </div>
                                        <div>
                                            <button style="text-decoration: none;border:none;decoration:none;background:none;" onclick="btnShowPostOnClick({{$ItemType->DonationTypeID}})">
                                                <h2 class="font-weight-bold">-</h2>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                            <div id="Collapse{{$ItemType->DonationTypeID}}" class="collapse show multi-collapse" aria-labelledby="heading{{$ItemType->DonationTypeID}}">
                                @foreach ($DonationTypeDetail as $ItemTypeDetail)
                                    @if ($ItemTypeDetail->DonationTypeID == $ItemType->DonationTypeID)
                                        <div>
                                            @include('Forum.Misc.component-form-post')
                                        </div>
                                    @endif
                            @endforeach
                                
                            </div>
                        </div>
    
                    </div>
                </div>
                @endforeach
    

                
            

        </div>
        {{-- LIST POST END HERE --}}

        {{-- POP UP CREATE POST START HERE --}}

        <div >
            @include('Forum.Misc.component-form-makepost')
        </div>

        <div >
            @include('Forum.Misc.component-form-popupalert')
        </div>

        {{-- POP UP CREATE POST End HERE --}}
    </div>


    
@endsection
