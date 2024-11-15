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
            // Si le mot de passe n'est pas au bon format, on retourne false
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

        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
        $statement->bindValue(':email', $email);
        if ($statement->execute()) {
            $user = $statement->fetch();
            if ($user !== false && password_verify($password, $user->getPassword())) {
                // On vérifie si le département de l'utilisateur est dans la liste des départements autorisés
                if (in_array($user->getDepartment(), ['75', '94', '92', '93'])) {
                    $user->addRole('ROLE_DELIVERABLE');
                }

                return $user;
            }
        }

        throw new Exception('Identifiants invalides');
    }
}