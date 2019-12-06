<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class);
    }

    public function comments()
    {
        return $this->hasmany(Comment::class);
    }

    public function scopeWhereCategory($query, $category)
    {
        if (!empty($category)) {
            return $query->where('tag_category_id', $category);
        }
    }
    
    public function scopeSearchTitle($query, $title)
    {
        if (!empty($title)) {
            return $query->where('title', 'LIKE', '%'.$title.'%');
        }
    }

}
