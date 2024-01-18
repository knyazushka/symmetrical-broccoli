<?php

namespace App\Repositories;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;

final class ProductRepository implements ProductRepositoryContract
{
    public function filter(array $filter = []): Paginator
    {
        $model = Product::query();

        foreach ($filter as $key => $value) {
            if ($key === 0) {
                $model->whereJsonContains(
                    column: 'properties->' . $key,
                    value: array_values($value),
                );
            } else {
                foreach ($value as $item) {
                    $model->orWhereJsonContains(
                        column: 'properties->' . $key,
                        value: $item,
                    );
                }
            }
        }

        return $model->simplePaginate(
            perPage: 40,
        );
    }
}
