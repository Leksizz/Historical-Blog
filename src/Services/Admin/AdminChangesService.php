<?php

namespace App\Src\Services\Admin;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use JetBrains\PhpStorm\NoReturn;

class AdminChangesService
{
    public function __construct(
        private readonly ResponseInterface $response,
        private readonly LoggerInterface   $logger,
    )
    {
    }

    #[NoReturn] public function getChanges(): void
    {
        $changes = [
            'user' => $this->logger->logs('user/changes'),
            'post' => $this->logger->logs('post/changes'),
            'admin' => $this->logger->logs('admin/changes')
        ];
        $this->response->json(['status' => 'success', 'result' => $changes])->send();
    }

}