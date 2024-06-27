<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 25; $i++) {
            DB::table('products')->insert([
                [
                    'name' => fake()->word(),
                    'price' => fake()->randomFloat(2, 10, 100),
                    'stock' => fake()->numberBetween(1, 25),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
