<?php

namespace App\Kernel\Middleware;

use App\Kernel\Middleware\MiddlewareInterface;

class Middleware implements MiddlewareInterface
{

    public function check(array $middlewares = []): void
    {
        // TODO: Implement check() method.
    }
}