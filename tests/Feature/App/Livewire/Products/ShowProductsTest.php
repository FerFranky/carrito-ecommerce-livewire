<?php

use App\Models\Product;
use Livewire\Livewire;
use App\Livewire\Products\ShowProducts;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('add to cart updates the cart and total', function () {
    $product = Product::factory()->create(['stock' => 10, 'price' => 100]);
    Livewire::test(ShowProducts::class)
        ->call('addToCart', $product->id)
        ->assertSee($product->name)
        ->assertSee($product->price)
        ->assertSet('total', 100);
});

test('remove from cart updates the cart and total', function () {
    $product = Product::factory()->create(['stock' => 10, 'price' => 100]);

    Livewire::test(ShowProducts::class)
        ->call('addToCart', $product->id)
        ->call('removeFromCart', $product->id)
        ->assertSet('total', 0);
});

test('delete from cart updates the cart and total', function () {
    $product = Product::factory()->create(['stock' => 10, 'price' => 100]);

    Livewire::test(ShowProducts::class)
        ->call('addToCart', $product->id)
        ->call('deleteFromCart', $product->id)
        ->assertSet('total', 0);
});

test('products are displayed in the view', function () {
    $products = Product::factory()->count(3)->create(['stock' => 10]);

    Livewire::test(ShowProducts::class)
        ->assertSee($products[0]->name)
        ->assertSee($products[1]->name)
        ->assertSee($products[2]->name);
});

test('can add a product to the cart from the interface', function () {
    $product = Product::factory()->create(['stock' => 10, 'price' => 100]);

    Livewire::test(ShowProducts::class)
        ->call('addToCart', $product->id)
        ->assertSee($product->name);
});

test('can remove a product from the cart from the interface', function () {
    $product = Product::factory()->create(['stock' => 10, 'price' => 100]);

    Livewire::test(ShowProducts::class)
        ->call('addToCart', $product->id)
        ->call('removeFromCart', $product->id)
        ->assertSet('total', 0);
});

test('can process payment', function () {
    $product = Product::factory()->create(['stock' => 10, 'price' => 100]);
    Livewire::test(ShowProducts::class)
        ->call('addToCart', $product->id)
        ->call('processPayment')
        ->assertSet('total', 0);
});