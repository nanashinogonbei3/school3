<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(LessonsTableSeeder::class);
        // $this->call(InstructorsTableSeeder::class);
        // $this->call(PeopleTableSeeder::class);
        // 追記
        $this->call(parent_categoriesTableSeeder::class);
        // 追記
    }
}
