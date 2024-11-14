<?php
/**
 * - Demonstrates secure querying and parameter binding with PDO
 * - Includes various fetch modes to retrieve data in different formats
 */

try {
    require_once './user.php';  // Assumes `user.php` defines a class with `getDisplayName()` method.
    
    // Establish the PDO connection
    $pdo = new PDO('mysql:host=localhost;dbname=management', 'root', 'MO3848seven_36');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Example with LIKE query using a prepared statement
    $search = 'su%';
    $sql1 = 'SELECT * FROM users WHERE username LIKE ?';
    $pdostmt = $pdo->prepare($sql1);
    
    // Bind the parameter by position
    $pdostmt->bindValue(1, $search, PDO::PARAM_STR);

    // Execute the statement
    if ($pdostmt->execute()) {
        // Set fetch mode to retrieve rows as `username` class instances
        //$pdostmt->setFetchMode(PDO::FETCH_CLASS, 'User');  // Ensure `User` class exists in `user.php`
        
        // Loop through and display fetched usernames using the `getDisplayName()` method
        while ($user = $pdostmt->fetchObject('User')) {
            echo $user->getDisplayName() . "\n";
        }
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'User');
        $users = $pdoStatement->fetchAll();
        foreach($users as $user) {
            echo $user->getDisplayName();
        }
    } else {
        // Log errors instead of displaying them directly to avoid exposing database structure
        error_log(print_r($pdostmt->errorInfo(), true));  // Write errors to the log file
        echo 'Error executing query. Please try again later.';
    }

    // Fetch a specific user by username
    $username = "sushigueras";
    $sql = "SELECT * FROM `users` WHERE `username` = :username";
    
    // Prepare the SQL statement and bind parameter
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the user data in associative array format
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($user);

} catch (PDOException $e) {
    // Display a friendly error message
    echo 'Error: Could not retrieve the list of users. Please try again later.';
    error_log($e->getMessage()); // Log actual error message for debugging purposes
}

echo memory_get_peak_usage();