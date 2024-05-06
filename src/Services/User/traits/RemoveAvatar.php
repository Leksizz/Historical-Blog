<?php

namespace App\Src\Services\User\traits;

trait RemoveAvatar
{
    private function removeAvatar(): bool
    {
        if (file_exists($this->oldAvatar) && $this->oldAvatar !== $this->defaultAvatar) {
            unlink($this->oldAvatar);
            return true;
        }
        return false;
    }
}