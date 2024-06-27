<?php

namespace App\Services\Payments;

use App\Models\Product;
use DB;

/**
 * Clase PasarelaFake para simular el procesamiento de pagos.
 */
class PasarelaFake
{
    /**
     * Procesa el pago de los productos en el carrito.
     *
     * @param array $cart El carrito de compras con los productos a pagar y descontar del stock.
     * @return void
     */
    public static function processPayment($cart)
    {
        $paymentMessage = 'Compra exitosa. Los items de tu carrito de compras te seran enviados dentro de poco.';
        $paymentError = 'No se pudo completar el pago.';
        DB::beginTransaction();
        try {
            foreach ($cart as $item) {
                Product::recalculateStockByProduct($item);
            }
            session()->flash('payment', $paymentMessage);
            DB::commit();
        } catch (\Throwable $th) {
            session()->flash('paymentError', $paymentError);
            DB::rollback();
        }
        session()->forget('cart');
    }
}