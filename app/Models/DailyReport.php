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

}
