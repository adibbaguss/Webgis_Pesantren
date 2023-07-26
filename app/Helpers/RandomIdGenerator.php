<?php

namespace App\Helpers;

use Ramsey\Uuid\Uuid;

class RandomIdGenerator
{
    public static function generateUniqueId()
    {
        $currentTime = now()->format('Ymd');
        $uuid = Uuid::uuid4()->toString();
        $randomId = substr(str_replace('-', '', $uuid), 0, 5);

        return $currentTime . $randomId;
    }
}
