<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Lesson extends Model
{

    protected $guarded = [
        'id', 'instructor_id',
    ];

    public static $rules = array(
        'lesson_name' => 'required',
        'category_id' => 'required',
        // ↑追加
        'describe' => 'required',
        'lesson_time' => 'required',
        'event_date' => 'required',
        'fee' => 'required',
        'capacity' => 'required',
        'img' => 'required',
    );

    //追加
    public function getDate()
    {
        return $this->id . ':' . $this->lesson_name . ' (' . $this->lesson_time . ')分';
    }


    //belongsTo設定 レッスンに対して、講師は一人
    public function Instructor()
    {
        return $this->belongsTo('App\Instructor');
    }

    // 講座１つに対して、（親）カテゴリーは数種類
    public function Parent_category()
    {
        return $this->belongsToMany('App\Parent_category','Lesson_categories','lesson_id','category_id')
        ->withTimestamps();
    }


}
