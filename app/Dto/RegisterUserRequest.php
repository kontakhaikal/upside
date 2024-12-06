<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\Validation\AlphaNumeric;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Password;


class RegisterUserRequest extends Data
{
    public function __construct(
        #[AlphaNumeric]
        #[Min(6)]
        #[Max(16)]
        #[Unique(table: 'users', column: 'username')]
        public string $username,
        #[Password(mixedCase: true, symbols: true, numbers: true)]
        public string $password
    ) {
    }
}
