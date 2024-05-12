<?php

namespace App\Src\Controllers\User;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\User\AuthService;
use JetBrains\PhpStorm\NoReturn;

class AuthController extends Controller
{
    public function index(): void
    {
        $this->view('user/login', 'Авторизация');
    }

    /**
     * @throws DTOException
     */
    #[NoReturn] public function login(): void
    {
        $dto = DTOFactory::createFromRequest($this->request(), 'user');
        $user = RepositoryFactory::getRepository('user', $this->db());
        $service = new AuthService($user, $dto, $this->response(), $this->auth(), $this->session(), $this->logger());
        $service->authentication();
    }

    #[NoReturn] public function logout(): void
    {
        $this->logger()->write("Пользователь " . $this->session()->getColumn('user', 'id') . " покинул сайт", "user/changes");
        $this->auth()->logout();
        $this->redirect('/');
    }

}