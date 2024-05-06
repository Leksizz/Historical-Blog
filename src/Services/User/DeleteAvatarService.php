<?php

namespace App\Src\Services\User;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;
use App\Src\Services\User\traits\RemoveAvatar;
use App\Src\Services\User\traits\SetTable;

class DeleteAvatarService
{
    private string $defaultAvatar;
    private string $oldAvatar;
    private int $id;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly ResponseInterface   $response,
        private readonly SessionInterface    $session,
        private readonly StorageInterface    $storage,
    )
    {

        $this->id = $this->session->get('user')['id'];
        $this->defaultAvatar = $this->storage->relativePath('user/user_avatar.jpg');
        $this->oldAvatar = $this->session->getColumn('user', 'avatar');
        $this->setTable();

    }


    use SetTable;

    public function deleteAvatar(): void
    {
        if (!$this->removeAvatar()) {
            $this->response->json(['status' => 'error', 'result' => 'Отсутствует файл для удаления'])->send();
        }
        if ($this->userRepository->edit([
            'table' => $this->table(),
            'set' => ['avatar' => $this->defaultAvatar],
            'where' => ['id' => $this->id],
        ])) {
            $this->session->setColumn('user', 'avatar', $this->defaultAvatar);
            $this->response->json(['status' => 'success', 'href' => '/profile'])->send();
        }
    }

    use RemoveAvatar;
}