<?php

namespace App\Src\Services\User;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;
use App\Src\Repositories\User\UserRepositoryInterface;
use App\Src\Services\User\traits\RemoveAvatar;

class DeleteAvatarService
{
    private string $defaultAvatar;
    private string $oldAvatar;
    private int $id;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ResponseInterface       $response,
        private readonly SessionInterface        $session,
        private readonly StorageInterface        $storage,
        private readonly LoggerInterface         $logger,
    )
    {

        $this->id = $this->session->get('user')['id'];
        $this->defaultAvatar = $this->storage->relativePath('default/user_avatar.jpg');
        $this->oldAvatar = $this->session->getColumn('user', 'avatar');
    }


    public function deleteAvatar(): void
    {
        if (!$this->removeAvatar()) {
            $this->response->json(['status' => 'error', 'result' => 'Отсутствует файл для удаления'])->send();
        }
        if ($this->userRepository->deleteAvatar($this->defaultAvatar, $this->id)) {
            $this->session->setColumn('user', 'avatar', $this->defaultAvatar);
            $this->logger->write("Пользователь " . $this->session->getColumn('user', 'id') . " удалил аватар", 'user/changes');
            $this->response->json(['status' => 'success', 'href' => '/profile'])->send();
        }
    }

    use RemoveAvatar;
}