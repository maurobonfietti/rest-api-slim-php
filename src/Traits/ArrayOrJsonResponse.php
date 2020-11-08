<?php

declare(strict_types=1);

namespace App\Traits;

trait ArrayOrJsonResponse
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toJson(): object
    {
        return json_decode((string) json_encode($this->toArray()), false);
    }
}
