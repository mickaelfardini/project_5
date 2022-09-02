<?php

declare(strict_types=1);

namespace App\Model\Entity;

final class Comment
{
    public function __construct(
        private int $id,
        private int $userName, 
        private string $text,
        private int $idPost,
        private int $validate,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserName(): int
    {
        return $this->userName;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getIdPost(): int
    {
        return $this->idPost;
    }
    public function getValidate(): int
    {
        return $this->validate;
    }
}
