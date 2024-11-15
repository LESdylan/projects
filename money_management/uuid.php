<?php
/**
 * to go further, add salt and pepper, double factors authentifications, verify_connection when user want to connect to the database
 * verif password and rules about it, 'azerty', 'birth_date', ...
 * hash the password
 * understand difference betweeen hash and cipher
 * ceil password
 */
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=management', 'root', 'MO3848seven_36');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Optional: To handle errors better

// Prepare the SQL insert statement (note: 'created_at' and 'updated_at' will be auto-filled by MySQL)
$stmt = $pdo->prepare('INSERT INTO users(username, password) VALUES (:username, :password)');

// Bind the input values to the prepared statement
$stmt->bindValue(':username', 'susana'); // You can change the username dynamically
$stmt->bindValue(':password', password_hash('regalo', PASSWORD_BCRYPT)); // Hash the password using BCRYPT

// Execute the statement
if ($stmt->execute()) {
    echo 'The user has been added';
} else {
    echo 'Impossible to create the user account.';
}

password_has()
$statement2 = $pdo->prepare('SELECT * FROM users WHERE username = :username');
$statement2->bindValue(':username', 'dylan');
$statement2->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);
if($user === false){
    echo 'invalid indentifiers';   
}else{
    if(password_verify('MO3848seven_36', $user['password']))
    {
        var_dump($user);
    }else{
        echo 'invalid login';
    }
}