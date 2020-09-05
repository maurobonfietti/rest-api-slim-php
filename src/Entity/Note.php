<?php

declare(strict_types=1);

namespace App\Entity;

final class Note
{
    /** @var int $id */
    private $id;

    /** @var string $name */
    private $name;

    /** @var string|null $description */
    private $description;

//    public function __construct($name = null, $description = null)
//    {
//        $this->name = $name;
//        $this->description = $description;
//    }

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

    public function getData(): self
    {
        return $this;
    }

    public function setlalala(): string
    {
        return 'lalala';
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
