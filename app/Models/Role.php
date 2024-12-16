<?php

namespace App\Models;

enum Role: string
{
    case ADMIN = 'admin';
    case MEMBER = 'member';
}


