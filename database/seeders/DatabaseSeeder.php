<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Brand::factory(20)->create();
        Category::factory(20)
            ->has(Product::factory(30))
            ->create();
        //Product::factory(50)
            //->has(Brand::factory(5))
            //->has(Category::factory(rand(1, 5))->create())
            //->has(Brand::factory(20)->create())
        //    ->create();


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
