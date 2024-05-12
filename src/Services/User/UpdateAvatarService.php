<?php

namespace App\Src\Services\User;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;
use App\Src\DTO\User\AvatarDTO;
use App\Src\Models\User\Avatar;
use App\Src\Repositories\User\UserRepositoryInterface;
use App\Src\Services\User\traits\RemoveAvatar;

class UpdateAvatarService
{
    private string $table;
    private Avatar $avatar;
    private string $defaultAvatar;
    private string $oldAvatar;
    private int $id;


    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly AvatarDTO|array         $dto,
        private readonly ResponseInterface       $response,
        private readonly SessionInterface        $session,
        private readonly StorageInterface        $storage,
        private readonly LoggerInterface         $logger,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $this->dto])->send();
        }

        $this->id = $this->session->get('user')['id'];
        $this->avatar = new Avatar($this->dto);
        $this->defaultAvatar = $this->storage->relativePath('user/user_avatar.jpg');
        $this->oldAvatar = $this->session->getColumn('user', 'avatar');
    }

    public function updateAvatar(): void
    {
        $this->removeAvatar();
        $avatar = $this->avatar->get();
        if ($this->userRepository->updateAvatar($avatar, $this->id)) {
            $this->session->setColumn('user', 'avatar', $this->storage->relativePath($avatar));
            $this->logger->write("Пользователь " . $this->session->getColumn('user', 'id') . " обновил аватар", 'user/changes');
            $this->response->json(['status' => 'success', 'href' => '/profile'])->send();
        }
    }

    use RemoveAvatar;
}