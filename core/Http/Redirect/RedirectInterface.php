<?php

namespace App\Core\Http\Redirect;

interface RedirectInterface
{
    public function to(string $url): void;
}