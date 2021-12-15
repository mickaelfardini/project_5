<?php

declare(strict_types=1);

namespace App\Model\Entity;

final class Comment
{
    public function __construct(
        private int $id,
        private string $pseudo, 
        private string $text,
        private int $idPost
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
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
}
