<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Clase Image
 *
 * @property int $id
 * @property string $url
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Image extends Model
{
    use HasFactory;
    /**
     * Nombre de la tabla (images) asociada al modelo.
     *
     * @var string
     */
    protected $table = 'images';
    /**
     * Define la relación polimórfica con otros modelos para las diferentes imagenes que gestiona el sistema.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
