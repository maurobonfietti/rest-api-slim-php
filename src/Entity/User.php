<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\ArrayOrJsonResponse;

final class User
{
    use ArrayOrJsonResponse;

    private int $id;

    private ?string $name = null;

    private ?string $email = null;

    private ?string $password = null;

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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function updateEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function updatePassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
