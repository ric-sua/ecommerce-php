<?php 
    $servername = 'SERVER_NAME';
    $databaseName = 'DATABASE_NAME';
    $username = 'USERNAME';
    $password = 'PASSWORD';

    try {
        $db = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    } catch (PDOException $e) {
        $error_message = 'Database Error: ';
        $error_message .= $e->getMessage();
        exit();
    }
