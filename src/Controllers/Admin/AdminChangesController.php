<?php

namespace App\Src\Controllers\Admin;

use App\Core\Controller\Controller;
use App\Src\Services\Admin\AdminChangesService;
use JetBrains\PhpStorm\NoReturn;

class AdminChangesController extends Controller
{
    public function index(): void
    {
        $this->view('/admin/changes', 'Изменения');
    }

    #[NoReturn] public function getChanges(): void
    {
        $service = new AdminChangesService($this->response(), $this->logger());
        $service->getChanges();
    }

}