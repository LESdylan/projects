<?php
/**
 * to go further, add salt and pepper, double factors authentifications, verify_connection when user want to connect to the database
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
