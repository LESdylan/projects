<?php

class User
{
    private string $id;
    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;
    private string $department;

    public function getPassword(): string
    {
        return $this->password;
    }

    public function sayHello(): string
    {
        return 'Bonjour '.$this->firstName.' '.$this->lastName;
    }
}