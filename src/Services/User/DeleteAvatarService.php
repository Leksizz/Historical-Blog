<?php

namespace App\Src\Services\User;

use App\Src\Services\User\traits\SetTable;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Core\Session\SessionInterface;

class DeleteAvatarService
{
    private string $table;
    private string $defaultAvatar;
    private string $oldAvatar;
    private int $id;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly ResponseInterface   $response,
        private readonly SessionInterface    $session,
    )
    {

        $this->id = $this->session->get('user')['id'];
        $this->defaultAvatar = '../storage/user/user_avatar.jpg';
        $this->oldAvatar = '../storage/' . $this->session->getColumn('user', 'avatar');
        $this->setTable();

    }


    use SetTable;

    public function deleteAvatar(): void
    {
        if (!$this->removeAvatar()) {
            $this->response->json(['status' => 'error', 'result' => 'Отсутствует файл для удаления'])->send();
        }
        if ($this->userRepository->edit('users', ['avatar' => $this->defaultAvatar], ['id' => $this->id])) {
            $this->session->setColumn('user', 'avatar', $this->defaultAvatar);
            $this->response->json(['status' => 'success', 'href' => '/profile'])->send();
        }
    }

    private function removeAvatar(): bool
    {
        if (file_exists($this->oldAvatar) && $this->oldAvatar !== $this->defaultAvatar) {
            unlink($this->oldAvatar);
            return true;
        }
        return false;
    }

}