<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPost extends Model
{
    protected $table = "msreportpost";
    protected $primaryKey = "ReportID";

    public function Post(){
        return $this->hasOne(Post::class, 'PostID', 'PostID');
    }

    public function ReportCategory()
    {
        return $this->hasOne(ReportCategory::class, 'ReportCategoryID', 'ReportCategoryID');
    }
}
