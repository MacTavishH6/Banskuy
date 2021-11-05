<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedAccount extends Model
{
    protected $table = "msbannedaccount";

    public function Report(){
        return $this->hasOne(Report::class, 'ReportID', 'ReportID');
    }
}
