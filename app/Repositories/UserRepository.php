<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function emailExists(string $email): bool
    {
        return !!User::where('email', $email)->first();
    }
}