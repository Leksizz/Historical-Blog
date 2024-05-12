<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableUsers extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');

        $table
            ->addColumn('name', 'string', ['length' => 50])
            ->addColumn('lastname', 'string', ['length' => 50])
            ->addColumn('nickname', 'string', ['length' => 50])
            ->addColumn('email', 'string', ['length' => 255])
            ->addColumn('password', 'string', ['length' => 255])
            ->addColumn('avatar', 'string', ['length' => 255, 'default' => 'user/user_avatar.jpg'])
            ->create();
    }
}
