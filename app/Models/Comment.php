<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'trcomment';

    public function Post(){
        return $this->hasOne(Post::class,'PostID','PostID');
    }
}
