<?php
/**
 * - Demonstrates secure querying and parameter binding with PDO
 * - Uses various fetch modes to retrieve data in different formats
 * - Includes error handling and logging for debugging
 * - Understand using of memory access, performance issues.
 * - system of index.
 * - learn how to control the flow of data.
 */
 /**
  * - Demonstrates secure querying and pagination with PDO
  * - Optimizes memory usage when fetching large data sets
  */
 
 try {
     require_once './user.php';  // Assumes `user.php` defines the `User` class with `getDisplayName()` method.
 
     // Establish the PDO connection
     $pdo = new PDO('mysql:host=localhost;dbname=management', 'root', 'MO3848seven_36');
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
     // Example with LIKE query using a prepared statement and pagination
     $search = 'su%';
     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
     $limit = 10;
     $start = ($page - 1) * $limit;
     
     $sql1 = 'SELECT * FROM users WHERE username LIKE ? LIMIT ?, ?';
     $pdostmt = $pdo->prepare($sql1);
 
     // Bind parameters for LIKE and LIMIT
     $pdostmt->bindValue(1, $search, PDO::PARAM_STR);
     $pdostmt->bindValue(2, $start, PDO::PARAM_INT);
     $pdostmt->bindValue(3, $limit, PDO::PARAM_INT);
 
     // Execute the statement and fetch results as `User` objects
     if ($pdostmt->execute()) {
         // Set fetch mode to retrieve rows as `User` class instances
         $pdostmt->setFetchMode(PDO::FETCH_CLASS, 'User');
 
         // Display fetched usernames using the `getDisplayName()` method
         while ($user = $pdostmt->fetch()) {
             echo htmlspecialchars($user->getDisplayName()) . "\n";
         }
     } else {
         // Log errors to avoid exposing database details
         error_log(print_r($pdostmt->errorInfo(), true));
         echo 'Error executing query. Please try again later.';
     }
 
     // Securely fetch a specific user by username
     $username = "sushigueras";
     $sql = "SELECT * FROM `users` WHERE `username` = :username";
 
     // Prepare the SQL statement and bind parameter
     $stmt = $pdo->prepare($sql);
     $stmt->bindParam(':username', $username, PDO::PARAM_STR);
 
     // Execute the statement and fetch one row at a time for large datasets
     $stmt->execute();
     while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
         var_dump($user);
     }
 
 } catch (PDOException $e) {
     // Display a friendly error message
     echo 'Error: Could not retrieve the list of users. Please try again later.';
     error_log($e->getMessage()); // Log error for debugging
 }
 
 // Display peak memory usage
 echo 'Peak Memory Usage: ' . number_format(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB';
 