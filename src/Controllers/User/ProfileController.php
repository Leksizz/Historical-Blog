<?php

namespace App\Src\Controllers\User;


use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Core\Repository\RepositoryInterface;
use App\Src\Repositories\User\UserRepository;
use App\Src\Services\User\DeleteAvatarService;
use App\Src\Services\User\GetUserService;
use App\Src\Services\User\UpdateAvatarService;
use JetBrains\PhpStorm\NoReturn;

class ProfileController extends Controller
{
    private RepositoryInterface $user;

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
        $service = new UpdateAvatarService($this->getUserRepository(), $dto, $this->response(), $this->session(), $this->storage());
        $service->updateAvatar();
    }

    public function deleteAvatar(): void
    {
        $service = new DeleteAvatarService($this->getUserRepository(), $this->response(), $this->session(), $this->storage());
        $service->deleteAvatar();
    }

    #[NoReturn] public function getUser(): void
    {
        $service = new GetUserService($this->getUserRepository(), $this->response(), $this->session());
        $service->getUser();
    }

    private function getUserRepository(): UserRepository
    {
        return $this->user = RepositoryFactory::getRepository('user', $this->db());
    }

}