<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\RegisterRequest;
use App\Contracts\Repository\UserRepositoryContract;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class RegistrationController
{
    use ValidatesRequests;

    public function __construct(
        private UserRepositoryContract $contract
    ){}

    /**
     * @throws ValidationException
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $this->validate($request, $request->rules());

        $this->contract->create(
            attributes: $request->validated(),
        );

        return new JsonResponse(
            data: [],
            status: Status::CREATED->value,
        );
    }
}
