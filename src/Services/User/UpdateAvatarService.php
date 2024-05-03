<?php

namespace App\Src\Services\User;

use App\Core\DTO\User\AvatarDTO;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Core\Session\SessionInterface;
use App\Core\Upload\FileUploader;
use App\Core\Upload\FileUploaderInterface;
use App\Src\Models\User\Avatar;
use App\Src\Services\User\traits\SetTable;

class UpdateAvatarService
{
    private string $table;
    private Avatar $avatar;
    private string $defaultAvatar;
    private string $oldAvatar;
    private int $id;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly AvatarDTO|array     $avatarDTO,
        private readonly ResponseInterface   $response,
        private readonly SessionInterface    $session,
    )
    {
        if (is_array($avatarDTO)) {
            $this->response->json(['status' => 'error', 'result' => $this->avatarDTO])->send();
        }

        $this->id = $this->session->get('user')['id'];
        $this->avatar = new Avatar($this->avatarDTO);
        $this->defaultAvatar = '../storage/user/user_avatar.jpg';
        $this->oldAvatar = '../storage/' . $this->session->getColumn('user', 'avatar');
        $this->setTable();

    }


    use SetTable;

    public function updateAvatar(): void
    {
        $this->removeAvatar();
        $avatar = $this->avatar()->move('user');
        if ($this->userRepository->edit('users', ['avatar' => $avatar], ['id' => $this->id])) {
            $this->session->setColumn('user', 'avatar', $avatar);
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

    private function avatar(): ?FileUploaderInterface
    {
        return new FileUploader(
            $this->avatar->name,
            $this->avatar->type,
            $this->avatar->tmpName,
            $this->avatar->error,
            $this->avatar->size,
        );
    }

}