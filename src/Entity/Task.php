<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\ArrayOrJsonResponse;

final class Task
{
    use ArrayOrJsonResponse;

    private int $id;

    private string $name;

    private ?string $description;

    private int $status;

    private int $userId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function updateName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function updateDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function updateStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function updateUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
