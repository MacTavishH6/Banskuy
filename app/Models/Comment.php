<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'trcomment';
    protected $primaryKey = 'CommentID';

    public function Post(){
        return $this->hasOne(Post::class,'PostID','PostID');
    }
    
    public function User(){
        return $this->hasOne(User::class,'UserID','ID');
    }
    public function Foundation(){
        return $this->hasOne(Foundation::class,'FoundationID','ID');
    }
}
