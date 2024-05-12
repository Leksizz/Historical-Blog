<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableComments extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('comments');

        $table
            ->addColumn('page', 'integer')
            ->addColumn('comment', 'string', ['length' => 255])
            ->addColumn('author', 'string', ['length' => 50])
            ->addColumn('date', 'string')
            ->create();
    }
}
