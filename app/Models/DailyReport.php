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
        'title',
        'content',
        'reporting_time'
    ];

    public function getDailyReport()
    {
        $paginateNum = 10;
        return $this->orderBy('reporting_time', 'desc')->paginate($paginateNum);
    }

    public function searchDailyReport($searchMonth)
    {
        return $this->where('reporting_time', 'LIKE', "%{$searchMonth}%")
                    ->orderBy('reporting_time', 'desc')
                    ->paginate(10);
    }
 

}
