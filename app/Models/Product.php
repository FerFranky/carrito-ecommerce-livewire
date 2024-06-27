<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Clase Product
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $stock
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Product extends Model
{
    use HasFactory;
    /**
     * Nombre de la tabla (products) asociada al modelo.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Define la relación polimórfica con una imagen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Obtiene la URL de la imagen del producto.
     * Si no hay imagen asociada, devuelve una URL de imagen de relleno.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? $this->image->url : 'https://placehold.co/400.png?text=Not_Found';
    }

    /**
     * Recalcula el stock del producto según la cantidad especificada.
     *
     * @param array $item El ítem se recalcula en base a 'product_id' y 'quantity'.
     * @return \App\Models\Product
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function recalculateStockByProduct($item)
    {
        $product = Product::findOrFail($item['product_id']);
        $product->stock = $product->stock - $item['quantity'];
        $product->save();
        return $product;
    }
}
