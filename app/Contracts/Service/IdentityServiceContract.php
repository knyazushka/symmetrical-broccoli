<?php

namespace App\Contracts\Service;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\NewAccessToken;

interface IdentityServiceContract
{
    public function login(array $attributes): bool;

    public function getAuthenticatedUser(): User|null|Authenticatable;

    public function createToken(Authenticatable|User $user, string $name, array $permissions = ['*']): NewAccessToken;
}
