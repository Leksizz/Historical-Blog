<?php

namespace App\Src\Services\Blog\SendSessionService;


use App\Core\Http\Response\ResponseInterface;
use App\Core\Session\SessionInterface;

class SendSessionService
{
    public function __construct(
        private readonly SessionInterface  $session,
        private readonly ResponseInterface $response,
    )
    {
    }

    public function sendSession(): void
    {
        if ($this->session->has('user')) {
            $this->response->json(['session' => $this->session->get('user')])->send();
        }
    }
}