<?php
// example on usage
include 'auth_site/database/index.php';    // Get DB connection (sets up DB if needed)
include 'auth_site/tables/index.php'; // Load table creation functions

// Get the connection (runs DB setup if needed)
$conn = setupDatabase();

// Set up specific tables by calling functions
createUsersTable($conn);  // Creates 'users' if not exists
createListsTable($conn);  // Creates 'lists' if not exists
// You can call more functions here if you add them to tables_setup.php

// Now use $conn for queries, e.g.:
// $result = $conn->query("SELECT * FROM users");
// Or insert: $conn->query("INSERT INTO lists (title, description) VALUES ('My List', 'Some desc')");

// Close connection when done
$conn->close();
?>