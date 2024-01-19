<?php

namespace App\Repositories;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

final class ProductRepository implements ProductRepositoryContract
{
    public function filter(array $filter = []): Paginator
    {
        $model = Product::query();

        $productIds = DB::table('product_properties')
            ->select('product_id')
            ->leftJoin('properties', 'properties.id', '=', 'product_properties.property_id')
            ->whereIn('properties.name', array_keys($filter));

        foreach (array_values($filter) as $value => $item) {
            $productIds->whereIn('value', $item);
        }

        $productIds->pluck('product_id');

        $model->whereIn('id', $productIds);

        return $model->simplePaginate(
            perPage: 40,
        );
    }
}
