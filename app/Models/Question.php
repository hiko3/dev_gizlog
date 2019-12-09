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

    /**
     * 質問タイトル検索
     *
     * @param mixed $query
     * @param string $title
     * @return Builderインスタンス
     */
    public function scopeSearchTitle($query, $searchWord)
    {
        if (!empty($searchWord)) {
            return $query->where('title', 'LIKE', '%'.$searchWord.'%');
        }
    }
    
    /**
     * カテゴリーの絞り込み
     *
     * @param mixed $query
     * @param int $category
     * @return Builderインスタンス
     */
    public function scopeWhereCategory($query, $categoryId)
    {
        if (!empty($categoryId)) {
            return $query->where('tag_category_id', $categoryId);
        }
    }

    public function searchOrDisplay($searchWord, $categoryId)
    {
        return $this->with(['tagCategory', 'comments'])
            ->searchTitle($searchWord)
            ->whereCategory($categoryId)
            ->orderBy('created_at', 'desc')
            ->paginate(config('const(QUESTION_PAGINATE_NUM)'));
    }

    public function showMypage($userId)
    {
        return $this->with(['tagCategory', 'comments'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(config('const(QUESTION_PAGINATE_NUM)'));
    }

}
