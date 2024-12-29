<?php

namespace App\Dto\Side;

use App\Models\Side;
use Spatie\LaravelData\Data;

class PopularSideData extends Data
{
    public function __construct(
        public string $id,
        public bool $isMember = false,
    ) {
    }

    public static function collectFromSideModel(Side $side): self
    {
        return self::from();
    }
}
