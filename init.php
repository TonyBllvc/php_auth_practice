<!-- auth_site/init.php -->
<?php
    // define('ROOT_PATH', __DIR__);
    include 'config/index.php';  // Load shared config
    include 'database/index.php';  // Get DB connection (sets up DB if needed)
    include 'tables/index.php'; // Load table creation functions
?>