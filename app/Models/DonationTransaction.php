<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationTransaction extends Model
{
    protected $table = 'trdonationtransaction';

    public function User(){
        return $this->belongsTo(User::class,'UserID','UserID');
    }

    public function Foundation(){
        return $this->belongsTo(Foundation::class,'FoudationID','FoundationID');
    }

    public function DonationTypeDetail(){
        return $this->hasOne(DonationTypeDetail::class,'DonationTypeDetailID','DonationTypeDetailID');
    }

    public function ApprovalStatus(){
        return $this->hasOne(ApprovalStatus::class,'ApprovalStatusID','ApprovalStatusID');
    }
}
