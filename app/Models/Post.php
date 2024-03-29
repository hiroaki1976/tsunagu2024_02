<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 割り当て許可
    protected $fillable = [
        'officename',
        'subject',
        'message', 
        'category_id',
        'user_id',
    ];

    public function comments()
    {
        // 投稿は複数のコメントを持つ
        return $this->hasMany('App\Models\Comment');
    }

    public function category()
    {
        // 投稿は1つのカテゴリーに属する
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * 任意のカテゴリを含むものとする（ローカル）スコープ
     * 
     */
    public function scopeCategoryAt($query, $category_id)
    {
        if (empty($category_id)) {
            return;
        }
    
        return $query->where('category_id', $category_id);
    }

    /**
     * 「名前・本文」検索スコープ
     */
    public function scopeFuzzyNameMessage($query, $searchword)
    {
        if (empty($searchword)) {
            return;
        }
    
        return $query->where(function ($query) use($searchword) {
            $query->orWhere('officename', 'like', "%{$searchword}%")
                ->orWhere('subject', 'like', "%{$searchword}%")
                ->orWhere('message', 'like', "%{$searchword}%");
        });
    }
}
