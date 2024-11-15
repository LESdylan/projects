<?php

require_once 'UserManager.php';

$pdo = new PDO('mysql:host=localhost;dbname=restaurant', 'root', '');
$manager = new UserManager($pdo);
$user = $manager->connect('john@doe.com', 'p4$$w0rd');
echo $user->sayHello();