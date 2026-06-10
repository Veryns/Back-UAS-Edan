<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'vearyn';

    $mysqli = new mysqli($host, $user, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection Failed: " . $mysqli->connect_error);
    }

    echo "Connected to MySQL successfully using mysqli.";
?>