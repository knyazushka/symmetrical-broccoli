<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $price
 * @property int $quantity
 * @property array $properties
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
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];
}
