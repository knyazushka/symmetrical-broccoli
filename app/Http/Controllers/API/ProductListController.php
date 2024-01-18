<?php

namespace App\Http\Controllers\API;

use App\Contracts\Repository\ProductRepositoryContract;
use App\Http\Requests\ProductListRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class ProductListController
{
    use ValidatesRequests;

    public function __construct(
        private ProductRepositoryContract $contract,
    ){}

    /**
     * @throws ValidationException
     */
    public function __invoke(ProductListRequest $request): JsonResponse
    {
        $this->validate($request, $request->rules());

        $data = $this->contract->filter($request->validated(
            key: 'properties',
        ));

        return new JsonResponse(
            data: $data,
            status: Status::OK->value,
        );
    }
}
