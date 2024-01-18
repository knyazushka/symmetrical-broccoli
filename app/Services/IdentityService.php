<?php

namespace App\Services;

use App\Models\User;
use App\Contracts\Service\IdentityServiceContract;
use App\Traits\HasAuthAndDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\NewAccessToken;

final class IdentityService implements IdentityServiceContract
{
    use HasAuthAndDatabase;

    public function login(array $attributes): bool
    {
        if (filter_var($attributes['emailOrPhone'], FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $attributes['emailOrPhone'], 'password' => $attributes['password']];
        } else {
            $credentials = ['phone' => $attributes['emailOrPhone'], 'password' => $attributes['password']];
        }

        return $this->auth->attempt(
            credentials: $credentials,
        );
    }

    public function getAuthenticatedUser(): User|null|Authenticatable
    {
        return $this->auth->user();
    }

    public function createToken(Authenticatable|User $user, string $name, array $permissions = ['*']): NewAccessToken
    {
        return $user?->createToken(
            name: $name,
            abilities: $permissions,
        );
    }
}
