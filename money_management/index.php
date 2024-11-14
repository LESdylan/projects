<?php
//hashing a password with a secure algorithm
// add salt and pepper
//password hashing workflow with bcrypt
//Store only the hash in mysql
//Enforcing strong password policies
// Use SSL/TLS Encryption
// Implement Rate Limiting on Login Attempts)
// Password Expiration and multi-factor authentification (MFA)
//
$query = sprintf("INSERT INTO `users`(password) VALUES('%s');", password_hash($password, PASSWORD_DEFAULT));
$result = pg_query($connection, $query);

$query = sprintf("SELECT `password` FROM `users` WHERE name='%s'",pg_escape_string($username));
$row = pg_fetch_assoc(pg_query($connection, $query));
if($row && password_verify($password, $row['pwd']))
{
    echo 'Hello, '. htmlspecialchars($username) . '!';
}else
{
    echo 'L\authentification failed for ' . htmlspecialchars($username) . '.';
}

$password = "MO384";
$hash =  password_hash($password, PASSWORD_BCRYPT);
echo "$hash\n";
if(password_verify($password, $hash))
{
    echo "password is valid !";
} else{
    echo "Invalid password.";
}
//