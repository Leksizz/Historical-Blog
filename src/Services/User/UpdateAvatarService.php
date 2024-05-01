<?php

namespace App\Src\Services\User;

use App\Core\DTO\User\UserDTO;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Src\Models\User\User;

class UpdateAvatarService
{
    private string $table;
    private User $user;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly UserDTO|array       $userDTO,
        private readonly ResponseInterface   $response
    )
    {
        if (is_array($userDTO)) {
            $this->response->json(['status' => 'error', 'result' => $userDTO])->send();
        }

        $this->user = new User($this->userDTO);
        $this->setTable();
    }

    private function setTable(): void
    {
        $this->table = 'users';
    }

    private function table(): string
    {
        return $this->table;
    }

    public function updateAvatar()
    {
        $fileName = $this->user->avatar()->move('user');
        dd($fileName);
    }

}