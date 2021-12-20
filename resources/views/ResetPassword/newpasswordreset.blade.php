@component('mail::message')
Hai

Sistem kami mendeteksi adanya permintaan setel ulang password
 
Berikut informasi terbaru akun anda <br>
@if (Auth::check())
Email : {{Auth::user()->Email}}
@elseif(Auth::guard('foundations')->check())
Email : {{Auth::guard('foundations')->user()->Email}}
@endif
<br>
Password : {{$newPassword}}

Apabila anda tidak melakukan setel ulang password, mohon segera kirim email ke admin1@banskuy.com

Salam Hangat<br>
Tim Banskuy<br>
@endcomponent
