<?php

use Illuminate\Database\Seeder;
use App\Instructor;
// 追記


class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 0;$i<20; $i++){
        Instructor::create([
            'last_name' => 'last_name',
            'first_name' => 'first_name',
            'profile' => 'NY、インドの老舗ホテルで修業、
             フードコーディネーターとして多数の著書を出版',
            'introduction' => 'スパイスを使ったNY、インドのレストランのレシピを皆さんと
            一緒に作ります',
            'img' => '画像',
          ]);
      }
    }



    // public function run()
    // {
    //      //
    //      DB::table('instructors')->truncate();
    //      DB::table('instructors')->insert([
    //          'last_name' => '水野',
    //          'first_name' => 'みちこ',
    //          'profile' => '〇〇大学栄養学博士課程卒業後、NY、インドの老舗ホテルで修業、
    //          フードコーディネーターとして多数の著書を出版',
    //          'introduction' => 'スパイスを使ったNY、インドのレストランのレシピを皆さんと
    //          一緒に作ります',
    //      ]);

    //      DB::table('instructors')->insert([
    //          'last_name' => 'Punjab',
    //          'first_name' => 'ジョン',
    //          'profile' => '日本生まれ、19歳からインド三ツ星レストランで長年修業し、1999年に日本で
    //          インド料理レストラン「ミース」を開く。インド料理の著書も多数',
    //          'introduction' => 'インドのスパイスを使った秘伝のレシピを皆さんと
    //          一緒に作ります',
    //      ]);

    //      DB::table('instructors')->insert([
    //          'last_name' => '向井',
    //          'first_name' => 'さとし',
    //          'profile' => '2011年に日本で
    //          インド料理レストラン「ナマステ」を開く。インド料理の著書も多数',
    //          'introduction' => 'インドの家庭料理、お菓子、パンを皆さんと
    //          一緒に作ります',
    //      ]);

    //      DB::table('instructors')->insert([
    //          'last_name' => '甲斐',
    //          'first_name' => 'まち子',
    //          'profile' => '1887年からメークアップアーティスト、美容家として雑誌やTVでも活躍。2006年からヨガスクール「ミューズ」を開校',
    //          'introduction' => 'インドヨガを中心に、美容、ダイエットなどについて、
    //          皆さんと楽しく学びましょう。',
    //      ]);

    //      DB::table('instructors')->insert([
    //          'last_name' => '清州',
    //          'first_name' => '俊道',
    //          'profile' => '2001年にインド工科大学マドラス校卒業。卒業後に起業し、
    //          IT企業のCEOに就任。ITに関する著書を多数執筆する中で、ヒンズー語講師としても活躍。
    //          〇HKやさしいヒンズー語講師を務める。',
    //          'introduction' => '
    //          皆さんと楽しくIT・ヒンズー語を学びましょう。',
    //      ]);
    //  }


}
