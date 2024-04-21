<?php

namespace App\Core\Middleware;

use App\Core\Auth\AuthInterface;
use App\Core\Http\Redirect\RedirectInterface;
use App\Core\Http\Request\RequestInterface;

abstract class Middleware implements MiddlewareInterface
{
    public function __construct(
        protected RequestInterface  $request,
        protected AuthInterface     $auth,
        protected RedirectInterface $redirect,
    )
    {
    }

    abstract public function handle(): void;
}