<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('categories')->insert([
                'name_category' => Str::random(10),
                'category_parent_id' => null,
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('categories')->insert([
                'name_category' => Str::random(10),
                'category_parent_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            DB::table('categories')->insert([
                'name_category' => Str::random(10),
                'category_parent_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            DB::table('categories')->insert([
                'name_category' => Str::random(10),
                'category_parent_id' => $i,
            ]);
        }

        for ($i = 11; $i <= 20; $i++) {
            DB::table('categories')->insert([
                'name_category' => Str::random(10),
                'category_parent_id' => $i,
            ]);
        }

        for ($i = 11; $i <= 15; $i++) {
            DB::table('categories')->insert([
                'name_category' => Str::random(10),
                'category_parent_id' => $i,
            ]);
        }
        for ($i = 11; $i <= 15; $i++) {
            DB::table('categories')->insert([
                'name_category' => Str::random(10),
                'category_parent_id' => $i,
            ]);
        }
    }
}
