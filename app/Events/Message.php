<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $date;
    public $username;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $message, $date,$username)
    {
        $this->user = $user;
        $this->message  =$message;
        $this->date = $date;
        $this->username = $username;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        
        return new PrivateChannel('chat.'.$this->user->UserID);
        
        // return new Channel('chat');
    }

    public function broadcastAs(){
        return 'message';
    }
}
