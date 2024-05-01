<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\User\UpdateAvatarService;

class ProfileController extends Controller
{
    public function index(): void
    {
        $this->view('user/profile', 'Профиль');
    }

    public function file()
    {
        dd(DTOFactory::createFromRequest($this->request(), 'avatar'));
        $user = RepositoryFactory::getRepository('user', $this->db());
        $service = new UpdateAvatarService($user, $dto, $this->response());
    // доделать вывод и обновление картинки
    }
}