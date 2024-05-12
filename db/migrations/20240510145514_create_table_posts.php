<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTablePosts extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('posts');

        $table
            ->addColumn('title', 'string', ['length' => 50])
            ->addColumn('preview', 'string', ['length' => 255])
            ->addColumn('content', 'string')
            ->addColumn('mainImage', 'string', ['length' => 255])
            ->addColumn('category', 'string', ['length' => 55])
            ->addColumn('author', 'string', ['length' => 55])
            ->addColumn('views', 'integer', ['default' => 0])
            ->
            create();
    }
}
