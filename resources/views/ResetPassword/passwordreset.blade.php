@component('mail::message')
Hai

Sistem kami mendeteksi adanya permintaan setel ulang password
 
Jika ini benar anda, silahkan klik tombol dibawah ini untuk melakukan setel ulang password anda
@if (Auth::check())
@component('mail::button', ['url' => Request::root().'/ResetPassword/'.Crypt::encrypt(Auth::user()->UserID)])
Setel Ulang Password
@endcomponent
@elseif(Auth::guard('foundations')->check())
@component('mail::button', ['url' => Request::root().'/ResetPasswordFoundation/'.Crypt::encrypt(Auth::guard('foundations')->user()->FoundationID)])
Setel Ulang Password
@endcomponent
@endif

Apabila anda tidak melakukan setel ulang password, mohon abaikan email ini

Salam Hangat<br>
Tim Banskuy<br>
@endcomponent
