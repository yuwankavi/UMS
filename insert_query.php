<?php
include("inc/connection.php");

// Create database if it doesn't exist
$createDbQuery = "CREATE DATABASE IF NOT EXISTS userdb";
if (mysqli_query($Connection, $createDbQuery)) {
    echo "Database 'userdb' created or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($Connection) . "<br>";
}

// Select the database
mysqli_select_db($Connection, "userdb");

// Create table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_deleted TINYINT(1) DEFAULT 0
)";

if (mysqli_query($Connection, $createTableQuery)) {
    echo "Table 'users' created or already exists.<br>";
} else {
    echo "Error creating table: " . mysqli_error($Connection) . "<br>";
}

// Insert data into the table
$first_name = "Yuwan";
$last_name = "Kavindu";
$email = "yuwan2002@gmail.com";
$password = "1234";
$is_deleted = 0;

$hashed_password = sha1($password);

$query = "INSERT INTO users (first_name, last_name, email, password, is_deleted) 
          VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', {$is_deleted})";

$result = mysqli_query($Connection, $query);

if ($result) {
    echo "Record 1 has been created successfully.";
} else {
    echo "Failed to create record: " . mysqli_error($Connection);
}

mysqli_close($Connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Query</title>
</head>
<body>
</body>
</html>