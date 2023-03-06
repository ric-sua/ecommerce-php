<?php 
    $servername = 'sql102.epizy.com';
    $databaseName = 'epiz_26028197_rusty_ecom';
    $username = 'epiz_26028197';
    $password = 'B2JS2sFvjZIouV';

    try {
        $db = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    } catch (PDOException $e) {
        $error_message = 'Database Error: ';
        $error_message .= $e->getMessage();
        exit();
    }
