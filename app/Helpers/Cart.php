<?php

namespace App\Helpers;

use App\Models\Product;

/**
 * Clase Cart para gestionar operaciones de un carrito de compras (Agregar, remover y eliminar items).
 */
class Cart
{
    /**
     * Añade un item al carrito.
     *
     * @param array $cart El carrito actual.
     * @param int $productId El ID del producto a añadir.
     * @return array El carrito actualizado (Se agrega un producto al mismo item o un nuevo item si aun no se ha agregado).
     */
    public static function addItemToCart($cart, $productId)
    {
        if (isset($cart[$productId])) {
            if (($cart[$productId]['quantity'] + 1) <= $cart[$productId]['stock']) {
                $cart[$productId]['quantity'] += 1;
                $cart[$productId]['total'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
            }
        } else {
            $product = Product::find($productId);
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->stock,
                'quantity' => 1,
                'total' => $product->price
            ];
        }
        return $cart;
    }
    /**
     * Elimina un item del carrito o reduce su cantidad en uno o lo elimina del carrito llegando a cero.
     *
     * @param array $cart El carrito actual.
     * @param int $productId El ID del producto a modificar.
     * @return array El carrito actualizado.
     */
    public static function removeItemToCart($cart, $productId)
    {
        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity'] -= 1;
                $cart[$productId]['total'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
            } else {
                unset($cart[$productId]);
            }
        }
        return $cart;
    }
    /**
     * Elimina completamente un artículo del carrito.
     *
     * @param array $cart El carrito actual.
     * @param int $productId El ID del producto a eliminar.
     * @return array El carrito actualizado con los items restantes.
     */
    public static function deleteCart($cart, $productId)
    {
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        return $cart;
    }
}