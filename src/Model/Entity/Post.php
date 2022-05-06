<?php

declare(strict_types=1);

namespace App\Model\Entity;

final class Post
{


    public function __construct(
        private int $id,
        private int $userId,
        private string $title,
        private string $chapo,
        private string $text,
        private string $createdAt,
        private string $updateAt 
        
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getChapo(): string
    {
        return $this->chapo;
    }

    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;
        return $this;
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdateAt(string $updateAt): self
    {
        $this->updateAt = $updateAt;
        return $this;
    }

    public function getUpdateAt(): string
    {
        return $this->updateAt;
    }

}
