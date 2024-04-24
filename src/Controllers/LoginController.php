<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\User\AuthService\AuthService;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('user/login', 'Авторизация');
    }

    /**
     * @throws DTOException
     */
    public function login(): void
    {
        $dto = DTOFactory::createFromRequest($this->request(), 'user');
        $user = RepositoryFactory::getRepository('user', $this->db());
        $service = new AuthService($user, $dto, $this->response(), $this->auth(), $this->session());
        $service->authentication();
    }

}