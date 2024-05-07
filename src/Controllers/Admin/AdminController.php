<?php

namespace App\Src\Controllers\Admin;

use App\Core\Controller\Controller;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\Admin\AdminService;
use JetBrains\PhpStorm\NoReturn;

class AdminController extends Controller
{
    public function index(): void
    {
        $this->view('admin/admin', 'Администратор');
    }

    public function users(): void
    {
        $this->view('admin/users', 'Пользователи');
    }

    #[NoReturn] public function getUsers(): void
    {
        $this->service()->getUsers();
    }


    public function service(): AdminService
    {
        $repository = RepositoryFactory::getRepository('admin', $this->db());
        return new AdminService($repository, $this->response(), $this->session());
    }
}