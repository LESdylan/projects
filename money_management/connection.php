<?php
/**
 * request used
 * query to retrieve information
 * exec recommended to execute some other query to modify the database
 * prepared request (prepration of request and then execution)
 * named marked
 * interogative marked
 * PDOstatement Object
 * give values to markers
 * execute a prepared request
 * stocked procedure
 */
try {
    require_once '.\user.php';
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
    if($pdostmt->execute())
    {
        //request OK
       // while($user = $pdostmt->fetch(PDO::FETCH_ASSOC)){
       //     echo htmlspecialchars($user['username']) . ' ' . htmlspecialchars($user['password']) . "\n";
       // }
       //while($user = $pdostmt->fetch(PDO::FETCH_NUM)){
       //     echo '</pre>';    
       //     print_r($user);
       //     echo '</pre>';
       // }
        //while($user = $pdostmt->fetch(PDO::FETCH_BOTH)){
        //    echo '</pre>';    
        //    print_r($user);
        //    echo '</pre>';
        //}
        //while($user = $pdostmt->fetch(PDO::FETCH_OBJ)){
        //    echo $user->username;
        //    echo '</pre>';    
        //    print_r($user);
        //    echo '</pre>';
        //}
        $pdostmt->setFetchMode(PDO::FETCH_CLASS, 'username' );

        while($user = $pdostmt->fetch()){
            echo $user->getdisplayName();
        }
    }else {
        //Error
        var_dump($pdoStatement->errorInfo()); //to display in a log file to avoid corruption of data.
    }
    
    // Fetch and display all users matching the LIKE pattern
 //   foreach ($pdostmt->fetchAll(PDO::FETCH_ASSOC) as $user) {
 //       echo htmlspecialchars($user['username']) . ' ' . htmlspecialchars($user['password']) . "\n";
 //   }

    // Securely fetch a specific user by username
    $username = "sushigueras";
    $sql = "SELECT * FROM `users` WHERE `username` = :username";
    
    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR); // link param by referenc
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the user data
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($user);

} catch (PDOException $e) {
    // Display a friendly error message
    echo 'Error: Could not retrieve the list of users. Please try again later.';
}
