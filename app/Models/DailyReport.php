<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'reporting_time'];
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time'
    ];

    public function searchDailyReport($id, $date)
    {
        return $this->where('user_id', $id)
                    ->when($date, function($query, $date) {
                        return $query->where('reporting_time', 'LIKE', "{$date}%");
                    })
                    ->orderBy('reporting_time', 'desc')
                    ->paginate(config('const.REPORT_PAGINATE_NUM'));
    }


}
