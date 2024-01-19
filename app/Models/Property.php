<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $value
 * @property Product[] $products
 */
final class Property extends Model
{
    protected $table = 'properties';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'value',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Product::class,
            table: 'product_properties',
        );
    }
}
