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
        if (strlen($password) < 8) {
            return false;
        }

        $statement = $this->pdo->prepare('
INSERT INTO users (id, email, password, firstName, lastName, department) 
VALUES (UUID(), :email, :password, :firstName, :lastName, :department)'
        );
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $statement->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindValue(':department', $department, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function connect(string $email, string $password): User
    {
        require_once 'User.php';

        // On cherche un utilisateur ayant l'adresse e-mail correspondante
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
        $statement->bindValue(':email', $email);
        if ($statement->execute()) {
            // Il y a une contrainte d'unicité sur l'e-mail : il n'est donc pas utile de faire une boucle
            $user = $statement->fetch();
            // Il faut vérifier que fetch n'a pas retourné false avant de vérifier le mot de passe
            if ($user !== false && password_verify($password, $user->getPassword())) {
                return $user;
            }
        }

        throw new Exception('Identifiants invalides');
    }
}