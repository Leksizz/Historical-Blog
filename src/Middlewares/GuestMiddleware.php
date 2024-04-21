<?php

namespace App\Middlewares;

use App\Core\Middleware\Middleware;

class GuestMiddleware extends Middleware
{
    public function handle(): void
    {
        if ($this->auth->check()) {
            $this->redirect->to('/');
        }
    }
}