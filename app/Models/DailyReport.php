<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $table = 'dailyreports';

    protected $dates = ['deleted_at', 'reporting_time'];

    protected $fillable = 
    [
        'user_id',
        'reporting_time',
        'title',
        'content'
    ];

    public function getDailyReport()
    {
        return $this->orderBy('reporting_time', 'desc')->paginate(10);
    }

    public function searchDailyReport($searchMonth)
    {
        return $this->where('reporting_time', 'LIKE', "%{$searchMonth}%")->orderBy('reporting_time', 'desc')->paginate(10);
    }
}
