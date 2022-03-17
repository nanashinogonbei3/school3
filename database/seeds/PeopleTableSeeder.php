<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('people')->truncate();
        \DB::table('people')->insert([
            'name' => '山田太郎',
            'email' => 'taro@yamada',
            'phone' => '08011111111',
        ]);

        \DB::table('people')->insert([
            'name' => '吉高由里子',
            'email' => 'yuriko@yoshitaka',
            'phone' => '08033333333',
        ]);

    }
}
