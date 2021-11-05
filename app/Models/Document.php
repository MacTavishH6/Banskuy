<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "msdocument";

    public function DocumentType(){
        return $this->hasOne(DocumentType::class, 'DocumentTypeID', 'DocumentTypeID');
    }

    
}
