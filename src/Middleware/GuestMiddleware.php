<?php

namespace App\Middleware;

use App\Kernel\Middleware\AbstractMiddleware;

class GuestMiddleware extends AbstractMiddleware
{

    /**
     * @return void
     */
    public function handle(): void
    {
        if($this->auth->check()){
            $this->redirect->to('/home');
        }
    }
}