<?php

require_once 'UserManager.php';

$pdo = new PDO('mysql:host=localhost;dbname=restaurant', 'root', '');
// Injection de l'objet PDO dans le manager
$manager = new UserManager($pdo);
if ($manager->subscribe('john@doe.com', 'p4$$w0rd', 'John', 'Doe', '2A')) {
    echo 'Inscription réussie';
} else {
    echo 'Echec lors de l\'inscription';
}