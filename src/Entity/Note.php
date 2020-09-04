<?php

declare(strict_types=1);

namespace App\Entity;

final class Note
{
    /** var int $id */
    public $id;

    /** var string $id */
    public $name;

    /** var string $id */
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

    public function getData()
    {
        return $this;
    }

    public function getData2()
    {
        $note = new \stdClass;
        $note->id = $this->getId();
        $note->name = $this->getName();
        $note->description = $this->getDescription();

        return $note;
    }

    public function getData3()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ];
    }
}
