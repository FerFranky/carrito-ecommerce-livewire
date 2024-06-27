<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = DB::query()->from('products')->select(['id', 'name'])->get()->shuffle();

        foreach ($products as $product) {
            DB::table('images')->insert([
                [
                    'url' => 'https://placehold.co/400.png?text='.$product->name,
                    'imageable_id' => $product->id,
                    'imageable_type' => 'product',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
