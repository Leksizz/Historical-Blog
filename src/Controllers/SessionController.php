<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Src\Services\Blog\SendSessionService\SendSessionService;

class SessionController extends Controller
{
    public function sendSession(): void
    {
        $service = new SendSessionService($this->session(), $this->response());
        $service->sendSession();
    }
}