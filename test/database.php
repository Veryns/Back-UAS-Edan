<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'vearyn');

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    if ($mysqli->connect_error) {
        die("Connection Failed: " . $mysqli->connect_error);
    }
?>