<?php

namespace App\Src\Controllers\User;


use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Src\Repositories\User\UserRepositoryInterface;
use App\Src\Services\User\DeleteAvatarService;
use App\Src\Services\User\GetUserService;
use App\Src\Services\User\UpdateAvatarService;
use JetBrains\PhpStorm\NoReturn;

class ProfileController extends Controller
{
    public function index(): void
    {
        $this->view('user/profile', 'Профиль');
    }

    /**
     * @throws DTOException
     */
    public function changeAvatar(): void
    {
        $dto = DTOFactory::createFromRequest($this->request(), 'avatar');
        $service = new UpdateAvatarService($this->userRepository(), $dto, $this->response(), $this->session(), $this->storage(), $this->logger());
        $service->updateAvatar();
    }

    public function deleteAvatar(): void
    {
        $service = new DeleteAvatarService($this->userRepository(), $this->response(), $this->session(), $this->storage(), $this->logger());
        $service->deleteAvatar();
    }

    #[NoReturn] public function getUser(): void
    {
        $service = new GetUserService($this->userRepository(), $this->response(), $this->session());
        $service->getUser();
    }

    private function userRepository(): UserRepositoryInterface
    {
        return RepositoryFactory::getRepository('user', $this->db());
    }

}