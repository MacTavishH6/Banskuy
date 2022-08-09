@component('mail::message')
Hai

Terimakasih sudah melakukan registrasi di website kami
 
Silahkan klik tombol dibawah ini untuk melakukan verfikasi email anda
@if (Auth::check())
@component('mail::button', ['url' => Request::root().'/VerifikasiEmail/'.Crypt::encrypt(Auth::user()->UserID)])
Verifikasi Email
@endcomponent
@elseif(Auth::guard('foundations')->check())
@component('mail::button', ['url' => Request::root().'/VerifikasiEmailFoundation/'.Crypt::encrypt(Auth::guard('foundations')->user()->FoundationID)])
Verifikasi Email
@endcomponent
@endif


Salam Hangat<br>
Tim Banskuy<br>
@endcomponent
