@extends('layouts.app')

@section('content')

{{-- <script src="./js/app.js"></script> --}}
<style>
.body_Message{
  max-height:80%;
  overflow-y:auto;
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
  overflow-y:auto;
}
.body_Message::-webkit-scrollbar{
  display: none;
}
.body_User{
  max-height:80%;
  overflow-y:auto;
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
  overflow-y:auto;
}
.body_User::-webkit-scrollbar{
  display: none;
}
</style>
<script>
    function btnSendCommentOnClick(){
   
        var message_username = document.getElementById('txtUsername');
        var message_content = document.getElementById('txtMessage');
        var receiverId = $('#txtId').val();
        var roleId = $('#roleId').val();
        //console.log(receiverId);
                $.ajax({
                    method: 'POST',
                    url : '\sendMessage',
                    data: {
                    role : roleId,
                    receiverId : receiverId,
                    message : message_content.value,
                    _token: "<?php echo csrf_token(); ?>"
                    }  ,
                    success:function(response){
                      if(response.payload != null){
                        var Data = {};
                        //console.log(response.payload);
                        Data.message = message_content.value;
                        Data.typeMessage = "flex-row-reverse";
                        Data.date = response.payload;
                        var divMessage = _.template($('#component-view-message').html());
                        $('.body_Message').append(divMessage({
                            data: Data
                        }));
                        message_content.value = "";
                      }
                      $("#bodyMessage").animate({ scrollTop: $('#bodyMessage').prop("scrollHeight")}, 0);  
                    }
                });
            }

            function btnChooseUserOnClick($val){
                    //console.log($val);
                    var receiverId = $($val).attr('data-id');
                    
                    $('#body_User button').removeClass("active");
                    $('#formSendMessage').removeClass('d-none');

                    $($val).addClass("active");
                    $('#titleMessage').html($('#body_User').find('.active div strong').html());
                    $('#txtId').val(receiverId);
                    $('#roleId').val($('#body_User').find('.active div input').val());
                    FetchMessage();
            }

            function FetchUser(){
              console.log({{isset($result)}});
              var chatTo = "{{$result['id']}}" != "0" ? "{{$result['id']}}" : "";
              var roleToId = "{{$result['roleId']}}" != "0" ? "{{$result['roleId']}}" : "";
            
                
                var currUser = {{isset(Auth::guard('foundations')->user()->FoundationID) ? Auth::guard('foundations')->user()->FoundationID: Auth::user()->UserID}};

              $.ajax({
                  method : 'POST',
                  url : '/GetListUserMessage',
                  data : {
                    _token: "<?php echo csrf_token(); ?>",
                    currUserId : currUser ,
                    chatTo : chatTo,
                    roleId : roleToId
                  },
                  success:function(response){
                     // console.log(response.payload);
                      if(response.payload != null){
                            var result = response.payload;
                            $('#body_User').empty();
                            result.forEach((element,index)=>{
                              var data = {};
                            
                              data.uname = element.username
                              data.date = element.date;
                              data.message = element.lastMessage;
                              data.id = element.userId;
                              data.name = "btn" + index;
                              data.role = element.roleId;
                              
                              if(chatTo != ""){
                                if(data.id == chatTo){
                                  data.name = "btnUClick";
                                }
                              }
                              var divUser = _.template($('#component-list-user').html());
                              $('#body_User').append(divUser({
                                data:data
                              }));
                              
                        });
                            
                      };
                  }
                }).then(function(){
                  if(chatTo != "") $('#btnUClick').click();
                });
            }

            function FetchMessage(){
              $.ajax({
                  method : 'POST',
                  url : '/getMessage',
                  data : {
                    _token: "<?php echo csrf_token(); ?>",
                    receiverId : $('#txtId').val()
                  },
                  success:function(response){
                      if(response.payload != null){
                          var result = response.payload;
                          var currId = {{isset(Auth::user()->UserID) ? Auth::user()->UserID : Auth::guard('foundations')->user()->FoundationID}};
                          // console.log(result);
                          $('.body_Message').empty();
                          result.forEach(element => {
                            var data = {};
                            data.message = element.messages;
                            data.date = element.date; 
                            
                            // baru dibuat khusu buat donatur aja
                            if(currId == element.senderId){
                              data.typeMessage = "flex-row-reverse";
                            }
                            else{
                              data.typeMessage = "flex-row";
                            }
                            var divMessage = _.template($('#component-view-message').html());
                            $('.body_Message').append(divMessage({
                                data: data
                            }));
                          });
                      };
                      $("#bodyMessage").animate({ scrollTop: $('#bodyMessage').prop("scrollHeight")}, 0);  
                  }
                });
            }


            $(function(){
              FetchUser();
              if({{isset(Auth::user()->UserID) ? "true": "false"}}){
                console.log("user");

                var Id = {{isset(Auth::user()->UserID) ? Auth::user()->UserID : "0"}};
                window.Echo.private('chat.' + Id)
                .listen('.message', (e) => {
                  var role = $('#roleId').val();
                    var username = $('#titleMessage').html();
                    if(username == e.username){
                        var Data = {};  
                        Data.message = e.message;
                        Data.typeMessage = "flex-row";
                        Data.date =  e.date;
                        var divMessage = _.template($('#component-view-message').html());
                        $('.body_Message').append(divMessage({
                            data: Data
                        }));
                        // var div = document.getElementById("bodyMessage");
                        // div.scrollTop = div.scrollHeight;
                        $("#bodyMessage").animate({ scrollTop: $('#bodyMessage').prop("scrollHeight")}, 0);
                    }
                  FetchUser();
                });
              }
              else{
                var id = {{isset(Auth::guard('foundations')->user()->FoundationID) ? Auth::guard('foundations')->user()->FoundationID: "0"}};
                console.log("found");
                window.Echo.private('chatFoundation.' + id)
                .listen('.messageFoundation', (e) => {
                  var role = $('#roleId').val();
                  
                  
  
                    var username = $('#body_User').find('.active div strong').html();
                    if(username == e.username){
                        var Data = {};  
                        Data.message = e.message;
                        Data.typeMessage = "flex-row";
                        Data.date =  e.date;
                        var divMessage = _.template($('#component-view-message').html());
                        $('.body_Message').append(divMessage({
                            data: Data
                        }));
                   }
                  FetchUser();
                });
              }
            });
</script>

    {{-- <div class="app" style="margin-bottom: 1000px">
        <div>
            <input type="text" id="txtUsername" name="txtUsername">
        </div>
        <div id="msgbody">

        </div>
        <div>
            <form id="msgForm">
                <input type="text" id="txtMessage" name="txtMessage">
                <button type="button" id="btnSend" onclick="btnSendCommentOnClick()">Send</button>
            </form>
            
        </div>
    </div> --}}
    <div class="d-flex flex-row mb-5 overflow-scroll" style="height:550px">
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white border" style="width: 380px;">
            <a href="#" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
              <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
              <span class="fs-5 fw-semibold">List Message</span>
            </a>
            <div class="body_User list-group list-group-flush border-bottom scrollarea" id="body_User" style="max-height: 90%;overflow-y:auto" >

            </div>
          </div>
           <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white border" style="width: 60%;">
            <a href="#" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-5 fw-semibold" id="titleMessage"></span>
              </a>
              <div id="bodyMessage" class="body_Message" style="max-height:78%;">
                {{-- <div class="d-flex flex-row">
                  <div class="p-2 border ml-2 mr-2">
                    <span style="font-size: 14pt" class="mr-3">Test</span>
                    <small class="text-muted">3 Dec 2021</small>
                  </div>
                </div>
                <div class="d-flex flex-row-reverse">
                  <div class="p-2 border mr-2">
                    <span style="font-size: 14pt" class="mr-3">Test</span>
                    <small class="text-muted">3 Dec 2021</small>
                  </div>
                </div> --}}
              </div>
              <div class="Form_Message mt-auto d-none" id="formSendMessage">
                    <div class="form-inline">
                        <div class="form-group w-100">
                            <input type="hidden" id="txtId" name="txtId" >
                            <input type="hidden" id="roleId" value="0">
                            <input type="hidden" id="statusActive">
                            <input type="text" class="form-control mr-3 ml-2 mb-2" autocomplete="off" style="min-width: 85%" id="txtMessage" name="txtMessage">
                            <button type="button" class="btn btn-banskuy text-white px-4 mb-2" onclick="btnSendCommentOnClick()">Send</button>
                        </div>
                    </div>
              </div>
          </div>
    </div>
    
@include('Message.Misc.component-view-message')
@include('Message.Misc.component-list-user')

@endsection