<?php

namespace App\Src\Controllers\Admin;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Src\DTO\User\UserDTO;
use App\Src\Services\Admin\AdminUsersService;
use JetBrains\PhpStorm\NoReturn;

class AdminUsersController extends Controller
{
    public function index(): void
    {
        $this->view('admin/users', 'Пользователи');
    }

    public function showEditUser(): void
    {
        $this->view('admin/editUser', 'Редактирование пользователя');
    }

    /**
     * @throws DTOException
     */
    #[NoReturn] public function getUsers(): void
    {
        $this->service()->getUsers();
    }

    /**
     * @throws DTOException
     */
    public function editUser(): void
    {
        $this->service()->editUser();
    }

    /**
     * @throws DTOException
     */
    public function deleteUser(): void
    {
        if ($this->service()->deleteUser()) {
            $this->redirect('/admin/users');
        }
    }

    /**
     * @throws DTOException
     */
    public function service(): AdminUsersService
    {
        $repository = RepositoryFactory::getRepository('admin', $this->db());
        return new AdminUsersService($repository, $this->response(), $this->dto(), $this->request(), $this->logger());
    }

    /**
     * @throws DTOException
     */
    private function dto(): UserDTO
    {
        return DTOFactory::createFromRequest($this->request(), 'user');
    }

}