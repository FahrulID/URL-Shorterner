<?php  
    // Input your database
    $host = "localhost";
    $dbname = "url_shortener";
    $username = "root";
    $password = "";

    try {
        // Create a new PDO and then save to $db
        $db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        // Setting Error Mode
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }
?>