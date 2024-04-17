<?php

namespace App\Core\Validator;
interface ValidatorInterface
{
    public function validate(array $data): bool;

    public function errors(): array|string;
}