<?php

namespace App\Contracts\Repository;

use App\Models\User;

interface UserRepositoryContract
{
    public function create(array $attributes): User;
}
