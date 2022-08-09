<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "msreport";
    protected $primaryKey = "ReportID";
    
    public function ReportCategory(){
        return $this->hasOne(ReportCategory::class, 'ReportCategoryID', 'ReportCategoryID');
    }
}
