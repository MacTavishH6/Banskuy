<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

use App\Models\Foundation;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Foundation.{id}', function ($foundation, $id) {
    return (int) $foundation->id === (int) $id;
});

Broadcast::channel('chat.{Receiver}',function($user,User $Receiver){
    
    // if(Auth::check()){
    //     return Auth::check();
    // }
    // else{
    //     return Auth::guard('foundations')->check();
    // }
    return true;
});

Broadcast::channel('chatFoundation.{Receiver}',function($foundation,Foundation $Receiver){

    // if(Auth::check()){
    //     return Auth::check();
    // }
    // else{
    //     return Auth::guard('foundations')->check();
    // }
    return true;
},['guards' => ['web','foundations']]);