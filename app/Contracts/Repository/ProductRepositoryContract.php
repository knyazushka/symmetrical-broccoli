<?php

namespace App\Contracts\Repository;

use Illuminate\Contracts\Pagination\Paginator;

interface ProductRepositoryContract
{
    public function filter(array $filter = []): Paginator;
}
