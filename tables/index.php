<!-- /tables/index.php -->
<?php
// 3. Function to create/check the 'users' table
function createUsersTable($conn) {
    $tableName = "users";

    // Check if table exists
    $tableExists = $conn->query("SHOW TABLES LIKE '$tableName'")->num_rows > 0;

    if (!$tableExists) {
        // Create table if not exists
        $sqlCreateTable = "
        CREATE TABLE $tableName (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            role ENUM('user', 'admin') NOT NULL DEFAULT 'user', 
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if ($conn->query($sqlCreateTable) === TRUE) {
            // echo "Users table created successfully.<br>"; // Optional: Remove in production
        } else {
            die("Error creating users table: " . $conn->error);
        }
    } else {
        // echo "Users table already exists.<br>"; // Optional debug
    }
}

// Function to create/check the 'lists' table
function createListsTable($conn) {
    $tableName = "lists";

    // Check if table exists
    $tableExists = $conn->query("SHOW TABLES LIKE '$tableName'")->num_rows > 0;

    if (!$tableExists) {
        // Create table if not exists
        $sqlCreateTable = "
        CREATE TABLE $tableName (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        if ($conn->query($sqlCreateTable) === TRUE) {
            // echo "Lists table created successfully.<br>"; // Optional: Remove in production
        } else {
            die("Error creating lists table: " . $conn->error);
        }
    } else {
        // echo "Lists table already exists.<br>"; // Optional debug
    }
}
?>