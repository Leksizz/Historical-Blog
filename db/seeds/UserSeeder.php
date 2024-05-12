<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'lastname' => 'Admin',
                'nickname' => 'Admin',
                'email' => 'Admin@mail.ru',
                'password' => 'Admin123',
                'avatar' => 'user/user_avatar.jpg',
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)->saveData();
    }
}
