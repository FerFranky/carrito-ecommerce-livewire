<?php
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Product::factory(10)->create();
});


test('should route return status 200', function () {
    $route = route('show-products.index');

    $response = $this->get($route);

    $response->assertStatus(200);
});

test('should return a list of products', function () {
    $route = route('show-products.index');
    $response = $this->get($route);
    $products = Product::all();
    foreach ($products as $product) {
        $response->assertSee($product->name);
        $response->assertSee($product->price);
        $response->assertSee($product->stock);
    }
});

test('should list of products has image', function () {
    $route = route('show-products.index');
    $response = $this->get($route);
    $products = Product::all();
    foreach ($products as $product) {
        $response->assertSee(asset($product->image));
    }
});