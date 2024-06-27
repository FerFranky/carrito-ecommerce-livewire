<?php

use App\Models\Product;
use App\Helpers\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('adds item to cart', function () {
    $cart = [];
    $product = Product::factory()->create();

    $updatedCart = Cart::addItemToCart($cart, $product->id);

    expect($updatedCart)->toHaveCount(1)
        ->and($updatedCart[$product->id])->toBe([
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'quantity' => 1,
            'total' => $product->price
        ]);
});

it('removes item from cart', function () {
    $cart = [
        1 => [
            'product_id' => 1,
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'quantity' => 2,
            'total' => 200
        ]
    ];

    $updatedCart = Cart::removeItemToCart($cart, 1);

    expect($updatedCart)->toHaveCount(1)
        ->and($updatedCart[1])->toBe([
            'product_id' => 1,
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'quantity' => 1,
            'total' => 100
        ]);
});

it('deletes item from cart', function () {
    $cart = [
        1 => [
            'product_id' => 1,
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'quantity' => 1,
            'total' => 100
        ]
    ];

    $updatedCart = Cart::deleteCart($cart, 1);

    expect($updatedCart)->toHaveCount(0);
});
