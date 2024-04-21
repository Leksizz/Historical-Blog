<?php

namespace App\Core\Repository;

use App\Core\DataBase\DataBaseInterface;

abstract class Repository
{
    public function __construct(protected DataBaseInterface $db)
    {
    }
}