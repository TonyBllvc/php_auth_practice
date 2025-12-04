<!-- /database/index.php -->
<?php

// require_once will issue a fatal error and the script will terminate immediately.
require_once 'config/index.php'; // Load shared config

// 2. Function to set up DB and return connection
function setupDatabase() {
    global $servername, $username, $password, $dbName;

    // Step 1: Connect to MySQL server
    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Step 2: Check if database exists
    $dbExists = $conn->query("SHOW DATABASES LIKE '$dbName'")->num_rows > 0;

    if (!$dbExists) {
        // Create database if not exists
        $sqlCreateDB = "CREATE DATABASE $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        if ($conn->query($sqlCreateDB) === TRUE) {
            // echo "Database created successfully.<br>"; // Optional: Remove in production
        } else {
            die("Error creating database: " . $conn->error);
        }
    } else {
        // echo "Database already exists.<br>"; // Optional debug
    }

    // Step 3: Select the database
    $conn->select_db($dbName);

    if (!$conn) {
        die("Failed to select database: " . $conn->error);
    }

    // Return the connection for use in other scripts
    return $conn;
}
?>