<?php

class UserManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function subscribe(string $email, string $password, string $firstName, string $lastName, string $department): bool
    {
        // Vérification de la taille du mot de passe
        if (strlen($password) < 8) {
            // Si le mot de passe n'est pas au bon format, on retourne false
            return false;
        }

        // Préparation de la requête
        $statement = $this->pdo->prepare('
INSERT INTO users (id, email, password, firstName, lastName, department) 
VALUES (UUID(), :email, :password, :firstName, :lastName, :department)'
        );

        // Injection des valeurs des marqueurs
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        // Hashage du mot de passe
        $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $statement->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindValue(':department', $department, PDO::PARAM_STR);

        // On retourne le statut d'exécution de la requête
        return $statement->execute();
    }
}