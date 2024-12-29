<?php

namespace App\Dto\Post;

enum PostType: string
{
    case LATEST = 'latest';
    case TRENDING = 'trending';
    case SUBSCRIBED = 'subscribed';

    public static function default(): string
    {
        return self::LATEST->value;
    }
}
