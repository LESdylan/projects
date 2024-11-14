<?php
class User
{
    private int $id;           // Corrected declaration
    private string $username;
    private string $password;

    // Constructor to initialize properties, if needed
    public function __construct()
    {
        // Constructor can be empty or used for initialization if necessary
    }

    // Method to get the display name
    public function getDisplayName(): string
    {
        return $this->username . ' ' . str_repeat('*', strlen($this->password));
    }
}
