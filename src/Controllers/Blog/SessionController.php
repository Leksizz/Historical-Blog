<?php

namespace App\Src\Controllers\Blog;

use App\Core\Controller\Controller;
use App\Src\Services\Blog\SendSessionService;
use JetBrains\PhpStorm\NoReturn;

class SessionController extends Controller
{
    #[NoReturn] public function sendSession(): void
    {
        $service = new SendSessionService($this->session(), $this->response());
        $service->sendSession();
    }
}