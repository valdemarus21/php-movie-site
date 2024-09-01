<?php

namespace App\Kernel\Auth;

class User
{
    public function __construct(
        private int $id,
        private string $email,
        private string $password,
        private string $name,
    )
    {


    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}