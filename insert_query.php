<?php
include("inc/connection.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $is_deleted = 0;

    // Hash the password
    $hashed_password = sha1($password);

    // Insert data into the table
    $query = "INSERT INTO users (first_name, last_name, email, password, is_deleted) 
              VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', {$is_deleted})";

    $result = mysqli_query($Connection, $query);

    if ($result) {
        echo "<p style='color: green;'>Record has been created successfully.</p>";
    } else {
        echo "<p style='color: red;'>Failed to create record: " . mysqli_error($Connection) . "</p>";
    }
}

// Create database if it doesn't exist
$createDbQuery = "CREATE DATABASE IF NOT EXISTS userdb";
if (mysqli_query($Connection, $createDbQuery)) {
    echo "<p style='color: green;'>Database 'userdb' created or already exists.</p>";
} else {
    echo "<p style='color: red;'>Error creating database: " . mysqli_error($Connection) . "</p>";
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
    echo "<p style='color: green;'>Table 'users' created or already exists.</p>";
} else {
    echo "<p style='color: red;'>Error creating table: " . mysqli_error($Connection) . "</p>";
}

mysqli_close($Connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>User Registration Form</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Register">
    </form>
</body>
</html>