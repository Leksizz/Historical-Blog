<?php

namespace App\Src\Services\Blog;


use App\Core\Http\Response\ResponseInterface;
use App\Core\Session\SessionInterface;
use JetBrains\PhpStorm\NoReturn;

class SendSessionService
{
    public function __construct(
        private readonly SessionInterface  $session,
        private readonly ResponseInterface $response,
    )
    {
    }

    #[NoReturn] public function sendSession(): void
    {
        if ($this->session->has('user')) {
            $this->response->json(['session' => $this->session->get('user')])->send();
        } else {
            $this->response->json(['session' => false])->send();
        }
    }
}