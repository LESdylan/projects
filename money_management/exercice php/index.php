<?php

require_once 'UserManager.php';

$pdo = new PDO('mysql:host=localhost;dbname=restaurant', 'root', '');
$manager = new UserManager($pdo);
$user = $manager->connect('john@doe.com', 'p4$$w0rd');

if (!in_array('ROLE_DELIVERABLE', $user->getRoles())) {
    throw new Exception('Accès interdit');
}