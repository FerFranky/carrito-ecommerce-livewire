<?php

namespace App\Livewire\Products;

use App\Helpers\Cart;
use App\Models\Product;
use App\Services\Payments\PasarelaFake;
use Livewire\Component;

/**
 * Componente Livewire para mostrar productos y gestionar un carrito de compras.
 */
class ShowProducts extends Component
{
    /** @var array Arreglo que contiene los elementos del carrito. */
    public $cartItems = [];
    /** @var float Total actual del carrito. */
    public $total = 0;
    /** @var array Eventos que escucha el componente y sus métodos asociados. */
    protected $listeners = ['cartUpdated' => 'render'];

    /**
     * Método que se ejecuta al inicializar el componente.
     * Carga el carrito de la sesión.
     *
     * @return void
     */
    public function mount()
    {
        $this->loadCart();
    }

    /**
     * Carga los elementos del carrito desde la sesión y calcula el total segun los items cargados.
     *
     * @return void
     */
    public function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->total = collect($this->cartItems)->sum('total');
    }

    /**
     * Añade un producto al carrito y recalcula el total.
     *
     * @param int $productId El ID del producto a añadir.
     * @return void
     */
    public function addToCart($productId)
    {
        $lastCart = session()->get('cart', []);
        $cart = Cart::addItemToCart($lastCart, $productId);
        $this->total = collect($cart)->sum('total');
        session()->put('cart', $cart);
        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    /**
     * Añade un producto al carrito.
     *
     * @param int $productId El ID del producto a añadir.
     * @return void
     */
    public function removeFromCart($productId)
    {
        $lastCart = session()->get('cart', []);
        $cart = Cart::removeItemToCart($lastCart, $productId);
        $this->total = collect($cart)->sum('total');
        session()->put('cart', $cart);
        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    /**
     * Elimina completamente un producto del carrito.
     *
     * @param int $productId El ID del producto a eliminar.
     * @return void
     */
    public function deleteFromCart($productId)
    {
        $lastCart = session()->get('cart', []);
        $cart = Cart::deleteCart($lastCart, $productId);
        $this->total = collect($cart)->sum('total');
        session()->put('cart', $cart);
        $this->loadCart();
        $this->dispatch('cartUpdated');
    }
    /**
     * Procesa el pago utilizando una pasarela de pago falsa para poder descontar los items al inventario.
     *
     * @return void
     */
    public function processPayment()
    {
        PasarelaFake::processPayment($this->cartItems);
        $this->loadCart();
    }

    /**
     * Renderiza el componente Livewire.
     * Obtiene los productos disponibles cuyo stock sea mayor a 0 y muestra la vista correspondiente.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $products = Product::where('stock', '>', 0)->with('image')->get();
        return view('livewire.products.show-products', [
            'products' => $products,
            'cartItems' => $this->cartItems,
            'total' => $this->total,
        ]);
    }
}
