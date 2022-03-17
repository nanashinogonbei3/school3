<?php

use Illuminate\Database\Seeder;
use App\parent_categories;

class parent_categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('parent_categories')->truncate();
        DB::table('parent_categories')->insert([
        'category_name' => 'インド料理',
        ]);

        DB::table('parent_categories')->insert([
            'category_name' => 'ペットのしつけ教室',
        ]);

        DB::table('parent_categories')->insert([
            'category_name' => '美容と健康',
        ]);

        DB::table('parent_categories')->insert([
            'category_name' => '舞踊・ダンス',
        ]);

        DB::table('parent_categories')->insert([
            'category_name' => '旅行',
        ]);

        DB::table('parent_categories')->insert([
            'category_name' => '開業・起業',
        ]);

        DB::table('parent_categories')->insert([
            'category_name' => 'インテリア',
        ]);
    }
}
