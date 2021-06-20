<?php

namespace Database\Seeders;

use App\Models\main_category;
use App\Models\sub_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        $faker = Faker::create();
        foreach (range(1,100) as $index){
//            $cat = new main_category();
//            $cat->category_name = $faker->name;
//            $cat->category_slug = Str::slug($cat->category_name);
//            $cat->save();


            $cat = new sub_category();
            $cat->main_category_id = rand(9,1008);
            $cat->category_name = $faker->name;
            $cat->category_slug = Str::slug($cat->category_name);
            $cat->save();

        }

    }
}
