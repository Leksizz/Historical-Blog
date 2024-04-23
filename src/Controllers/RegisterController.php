<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\RegisterService\RegisterService;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('user/register', 'Регистрация');
    }

    public function register(): void
    {
        $dto = DTOFactory::createFromRequest($this->request(), 'user');
        $user = RepositoryFactory::getRepository('user', $this->db());
        $service = new RegisterService($user, $dto, $this->response());
        $service->register();
    }
}