<?php

namespace App\Core\Http\Redirect;

class Redirect implements RedirectInterface
{
    public function to(string $url): void
    {
        header("Location: $url");
        exit();
    }
}