<?php

    session_start(); // To access session storage
    session_unset(); // To delete all session variables
    session_destroy(); // To terminate active session, removing all session activities
    header("Location: ../index.php");
    exit();

?>