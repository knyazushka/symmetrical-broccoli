<?php

namespace App\Repositories;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Query\Builder;

final class ProductRepository implements ProductRepositoryContract
{
    public function filter(array $filter = []): Paginator
    {
        $model = Product::query();

        $model->whereIn('id', function (Builder $q) use ($filter) {
            $q->select('product_id')->from('product_properties')
                ->leftJoin('properties', 'properties.id', '=', 'product_properties.property_id')
                ->whereIn('properties.name', array_keys($filter));
            foreach (array_values($filter) as $value => $item) {
                $q->whereIn('value', $item);
            }
        });

        return $model->simplePaginate(
            perPage: 40,
        );
    }
}
