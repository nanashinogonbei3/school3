<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_category extends Model
{
    // カテゴリーに対して、講座は複数
    public function lesson()
    {
        return $this->belongsToMany('App\Lesson','Lesson_category','category_id','lesson_id');
    }

    // カテゴリー一覧を取得
    public function getLists()
    {
        $parentCategory = Parent_category::orderBy('id','asc')->pluck('category_name', 'id');

        return $parentCategory;
    }
}
