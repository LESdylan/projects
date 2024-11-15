<?php

class User
{
    private string $id;
    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;
    private string $department;
    private array $roles = [];

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function sayHello(): string
    {
        return 'Bonjour '.$this->firstName.' '.$this->lastName;
    }

    public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}