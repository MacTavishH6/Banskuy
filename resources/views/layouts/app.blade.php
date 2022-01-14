<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BanSkuy') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ env('FTP_URL') }}assets/favicon.ico" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- CustomStyles --}}
    @yield('styles')
</head>

<body>
    <div id="app">
        @include('Shared._header')
        <main class="">
            @yield('content')
        </main>

        @include('Shared._footer')
        @include('Shared._loading')
    </div>

    @yield('scripts')
    <script type="text/javascript">
        var toastsuccess = <?php echo session('toastsuccess') ? '"' . session('toastsuccess') . '"' : '""'; ?>;

        var toasterror = <?php echo session('toasterror') ? '"' . session('toasterror') . '"' : '""'; ?>;
        $(document).ready(function() {
            if (toastsuccess) toastr.success(toastsuccess);
            if (toasterror) toastr.error(toasterror)
        });

        $(function() {

            $.ajax({
                type: 'GET',
                url: '/GetListNotificationPost',
                datType: 'json',
                success: function(response) {
                    var result = response.payload;
                    if (result != null && result.length > 0) {
                        var unReadNotif = 0;
                        result.forEach(element => {
                            var data = {};
                            if (element.StatusNotification == 1) {
                                unReadNotif += 1;
                            }
                            data.title = element.notification.NotificationHeader;
                            data.content = element.notification.NotificationContent;
                            data.postId = element.notification.PostID;

                            var divPostNotif = _.template($('#component-view-postnotification')
                                .html());
                            $('#dropdownNotification').prepend(divPostNotif({
                                data: data
                            }));
                        });
                        if (unReadNotif > 0) {
                            $('#imgBell').css("color", "blue");
                            $('#lblPostNotificationCount').html(parseInt(unReadNotif));
                        }

                    }
                }
            });

            $("#navbarNotification").click(function() {
                if ($('#ddlNotifStatus').val() == "hide") {
                    $('#dropdownNotification').addClass("show");
                    $('#ddlNotifStatus').val("show");

                    $.ajax({
                        type: 'GET',
                        url: '/SetReadNotification',
                        success: function(response) {
                            $('#imgBell').css("color", "gray");
                            $('#lblPostNotificationCount').html("");
                        }
                    });
                } else {
                    $('#dropdownNotification').removeClass("show");
                    $('#ddlNotifStatus').val("hide");

                }
            });
            window.Echo.channel('notification1')
                .listen('.notif', (e) => {
                    var data = {};
                    data.title = e.notification.NotificationHeader;
                    data.content = e.notification.NotificationContent;
                    data.postId = e.notification.PostID;
                    var divPostNotif = _.template($('#component-view-postnotification').html());
                    $('#dropdownNotification').prepend(divPostNotif({
                        data: data
                    }));
                    $('#imgBell').css("color", "blue");
                    if ($('#lblPostNotificationCount').html() == "") {
                        $('#lblPostNotificationCount').html(parseInt("1"));
                    } else {
                        $('#lblPostNotificationCount').html(parseInt($('#lblPostNotificationCount').html()) +
                            1);
                    }

                });
        });
    </script>
</body>

</html>
