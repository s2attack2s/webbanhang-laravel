<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(2)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Footer::factory(1)->create();
        \App\Models\Slider::factory(5)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\Partner::factory(20)->create();
    }
}
