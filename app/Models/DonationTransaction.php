<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationTransaction extends Model
{
    protected $table = 'trdonationtransaction';
    protected $primaryKey = 'DonationTransactionID';

    public function User(){
        return $this->belongsTo(User::class,'UserID','UserID');
    }

    public function Foundation(){
        return $this->hasOne(Foundation::class, 'FoundationID','FoundationID');
    }

    public function DonationTypeDetail(){
        return $this->hasOne(DonationTypeDetail::class,'DonationTypeDetailID','DonationTypeDetailID');
    }

    public function ApprovalStatus(){
        return $this->hasOne(ApprovalStatus::class,'ApprovalStatusID','ApprovalStatusID');
    }

    public function Post()
    {
        return $this->hasOne(Post::class, 'PostID', 'PostID');
    }
}
