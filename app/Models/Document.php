<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "msdocument";
    protected $primaryKey = "DocumentID";

    public function DocumentType(){
        return $this->hasOne(DocumentType::class, 'DocumentTypeID', 'DocumentTypeID');
    }

    public function ApprovalStatus(){
        return $this->hasOne(ApprovalStatus::class, 'ApprovalStatusID','ApprovalStatusID');
    }

    public function Foundation(){
        return $this->belongsTo(Foundation::class,'FoundationID');
    }
    
}
