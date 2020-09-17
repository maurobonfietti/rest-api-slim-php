<?php

declare(strict_types=1);

namespace App\Entity;

final class Task
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string|null */
    private $description;

    /** @var int */
    private $status;

    /** @var int */
    private $userId;

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

    public function getData(): object
    {
        $task = new \stdClass();
        $task->id = $this->getId();
        $task->name = $this->getName();
        $task->description = $this->getDescription();
        $task->status = $this->getStatus();
        $task->userId = $this->getUserId();

        return $task;
    }
}
