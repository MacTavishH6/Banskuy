<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "msreport";
    
    public function ReportCategory(){
        return $this->hasOne(ReportCategory::class, 'ReportCategoryID', 'ReportCategoryID');
    }
}
