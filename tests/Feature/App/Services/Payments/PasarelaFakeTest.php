<?php

use App\Services\Payments\PasarelaFake;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

uses(RefreshDatabase::class);

it('processes payment successfully', function () {
    Product::factory(2)->create(['stock' => 10]);
    $cart = [
        ['product_id' => 1, 'quantity' => 2],
        ['product_id' => 2, 'quantity' => 1],
    ];

    PasarelaFake::processPayment($cart);

    expect(Session::get('payment'))->toBe('Compra exitosa. Los items de tu carrito de compras te seran enviados dentro de poco.');

    expect(Session::get('cart'))->toBeNull();

    $product1 = Product::find(1);
    $product2 = Product::find(2);

    expect($product1->stock)->toBe(8);
    expect($product2->stock)->toBe(9);
});

it('handles payment failure', function () {
    Product::factory()->create(['stock' => 10]);
    $cart = [
        ['product_id' => 1],
    ];
    PasarelaFake::processPayment($cart);

    expect(Session::get('paymentError'))->toBe('No se pudo completar el pago.');
    expect(Session::get('cart'))->toBeNull();

    $product1 = Product::find(1);
    expect($product1->stock)->toBe(10);
});