<?php

namespace App\Src\Controllers\User;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\User\RegisterService;
use JetBrains\PhpStorm\NoReturn;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('user/register', 'Регистрация');
    }

    /**
     * @throws DTOException
     */
    #[NoReturn] public function register(): void
    {
        $dto = DTOFactory::createFromRequest($this->request(), 'user');
        $user = RepositoryFactory::getRepository('user', $this->db());
        $service = new RegisterService($user, $dto, $this->response(), $this->logger());
        $service->register();
    }
}