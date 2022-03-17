<?php

use Illuminate\Database\Seeder;
use App\Lesson;
// 追記


class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0;$i<20; $i++){
            Lesson::create([
              'instructor_id' => 1,
              'lesson_name' => Str::random(30),
              'describe' => Str::random(24),
              'lesson_time' => 60,
              'event_date' => date('Y-m-d'),
              'fee' => 5000,
              'capacity' => 11,
              'img' => '1',
            ]);
        }

    }
}
