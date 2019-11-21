<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'reporting_time'];
    protected $fillable = 
    [
        'user_id',
        'title',
        'content',
        'reporting_time'
    ];

    public function getDailyReport($id)
    {
        define("paginateNum", 10);
        return $this->where('user_id', $id)->orderBy('reporting_time', 'desc')->paginate(paginateNum);
    }

    public function searchDailyReport($id, $searchMonth)
    {
        return $this->where('user_id', $id)
                    ->where('reporting_time', 'LIKE', "%{$searchMonth}%")
                    ->orderBy('reporting_time', 'desc')
                    ->paginate(10);
    }
 

}
