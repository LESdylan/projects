<?php
//advert to change of password
$pdo = new PDO('mysql:host=localhost;dbname=intro_pdo', 'root', '');
// On récupère tous les utilisateurs
$statement = $pdo->prepare('SELECT * FROM users');
if ($statement->execute()) {
    while ($user = $statement->fetch(PDO::FETCH_ASSOC)) {
        // Pour tous les utilisateurs, on vérifie si leur mot de passe correspond à celui compromis
        if (password_verify('ch4t0n!', $user['password'])) {
            echo $user['email'].'<br>';
        }
    }
} else {
    echo 'Impossible de récupérer la liste des utilisateurs';
}

```CREATE TABLE users (
  email varchar(254) NOT NULL,
  username varchar(20) UNIQUE NOT NULL,
  password varchar(60) NOT NULL
);
INSERT INTO users (email, username, password) VALUES
('dupond@monmail.com', 'rodupond', '$2y$10$vEx3REIRj.omkixkE2IMruhroKKA0Lzz/xtL6fFQQ.9irK55DaLsK'),
('jeremy.bratus@monmail.com', 'Jrm', '$2y$10$YbXLnPthaF.yjsWZXAnno.q.HU7AQcJP86Q0NxiAtebiPo93ijVlK'),
('john@doe.fr', 'john', '$2y$10$ClqJp6rOm3NehGNxaZbU5eOhZfCJQabcsFpQUWqw5xRk7sQxL9xHO'),
('laure@mondi.com', 'laure', '$2y$10$wbiuoUtEJ8FYUYjaG.x5Qe1NGX0VaU61XFqFxOh9LFqvqIwHu2qbS'),
('sarah@monmail.com', 'Saraaa', '$2y$10$OErjVwZeJLjNLyYh4l2m9eRJYLGGoKpXwVvl9COtW4EM8NQw0DJ8y'),
('sophie@granf.com', 'soso', '$2y$10$7hGEtxVUDb.UWSdq8HkW.O7wMskSi9tZmPEMujzDxjPPOYCsluuu2');
```