<?php

use App\Models\Product;
use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('calculates stock correctly after updating', function () {
    $product = Product::factory()->create(['stock' => 10]);

    $item = [
        'product_id' => $product->id,
        'quantity' => 3,
    ];

    $updatedProduct = Product::recalculateStockByProduct($item);

    expect($updatedProduct->stock)->toBe(7);
});

it('returns a placeholder image URL when no image is set', function () {
    $product = Product::factory()->create();

    expect($product->getImageUrlAttribute())->toBe('https://placehold.co/400.png?text=Not_Found');
});

it('returns the correct image URL when an image is set', function () {
    $product = Product::factory()->has(Image::factory()->state(['url' => 'https://example.com/image.jpg']))->create();
    expect($product->getImageUrlAttribute())->toBe('https://example.com/image.jpg');
});
