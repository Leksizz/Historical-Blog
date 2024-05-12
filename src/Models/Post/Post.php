<?php

namespace App\Src\Models\Post;

use App\Core\Session\SessionInterface;
use App\Core\Upload\FileUploader;
use App\Src\DTO\Post\PostDTO;

class Post
{
    private string $title;
    private array $preview;
    private string $content;
    private array $mainImage;
    private string $category;
    private string $author;

    public function __construct(PostDTO $dto, SessionInterface $session)
    {
        $this->title = $dto->title;
        $this->preview = $dto->preview;
        $this->content = $dto->content;
        $this->mainImage = $dto->mainImage;
        $this->category = $dto->category;
        $this->author = $session->getColumn('user', 'nickname');
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function preview(): string
    {
        $preview = new FileUploader(
            $this->preview['name'],
            $this->preview['type'],
            $this->preview['tmp_name'],
            $this->preview['error'],
            $this->preview['size'],
        );
        return $preview->move('post');
    }

    public function mainImage(): string
    {
        $mainImage = new FileUploader(
            $this->mainImage['name'],
            $this->mainImage['type'],
            $this->mainImage['tmp_name'],
            $this->mainImage['error'],
            $this->mainImage['size'],
        );
        return $mainImage->move('post');
    }

    public function author()
    {
        return $this->author;
    }

    public function get(): array
    {
        return [
            'title' => $this->title(),
            'preview' => $this->preview(),
            'content' => $this->content(),
            'mainImage' => $this->mainImage(),
            'category' => $this->category(),
            'author' => $this->author(),
        ];
    }
}