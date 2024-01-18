<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\LoginRequest;
use App\Contracts\Service\IdentityServiceContract;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class LoginController
{
    use ValidatesRequests;

    public function __construct(
        private IdentityServiceContract $service,
    ){}

    /**
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $this->validate($request, $request->rules());

        if (!$this->service->login(attributes: $request->validated())) {
            throw ValidationException::withMessages(
                messages: [
                    'email' => 'Invalid credentials.',
                ]
            );
        }

        $token = $this->service->createToken(
            user: $this->service->getAuthenticatedUser(),
            name: config('app.name'),
        );

        return new JsonResponse(
            data: [
                'token' => $token->plainTextToken,
            ],
            status: Status::OK->value,
        );
    }
}
