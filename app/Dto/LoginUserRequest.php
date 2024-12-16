<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class LoginUserRequest extends Data
{
    public function __construct(
        public string $username,
        public string $password,
        public bool $rememberMe
    ) {
    }
}
