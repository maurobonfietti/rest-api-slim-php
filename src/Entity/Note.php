<?php

declare(strict_types=1);

namespace App\Entity;

final class Note
{
    /** @var int $id */
    public $id;

    /** @var string $name */
    protected $name;

    /** @var string|null $description */
    public $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getData(): self
    {
        return $this;
    }

    public function getData2(): object
    {
        $note = new \stdClass();
        $note->id = $this->getId();
        $note->name = $this->getName();
        $note->description = $this->getDescription();

        return $note;
    }

    public function getData3(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ];
    }

    public function getData4(): object
    {
//        $note = new Note();
        $this->id = $this->getId();
        $this->name = $this->getName();
        $this->description = $this->getDescription();

        return $this;
    }
}
