<?php
// I would like to create a file that handle automatically all the queries sql
$pdo = new PDO('mysql:host=localhost;dbname=ozak_shop', 'root', 'yourpassword');
$directory = __DIR__ . '/../database/migrations';

foreach (glob("$directory/*.sql") as $filename) {
    $sql = file_get_contents($filename);
    $pdo->exec($sql);
    echo "Executed: $filename\n";
}
