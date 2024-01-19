<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property int $price
 * @property int $quantity
 * @property CarbonInterface|string $created_at
 * @property CarbonInterface|string $updated_at
 */
final class Product extends Model
{
    protected $table = 'products';

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'price',
        'quantity',
    ];

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Property::class,
            table: 'product_properties',
        );
    }
}
