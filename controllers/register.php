<!-- /controller/register.php -->
<?php 

    session_start(); // The session_start() function in PHP initializes a new session or resumes an existing one. It is crucial for managing user data across multiple page requests on a website.
    // It allows user to store session data and retrieve session data on and from server
    // Get DB connection (sets up DB if needed)
    require_once 'index.php'; // require_once will issue a fatal error and the script will terminate immediately.

    
    // Get the connection (runs DB setup if needed)
    $conn = setupDatabase();

    $name = $email = $password = $role = "";

    // $_POST['..'] : This allows use to get data from the post request sent by a html form calling this script.

    if (isset($_POST['register'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        // $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'"); // Straight forward approach
        
        // or

        // to add SQL injection protection
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $checkEmail = $stmt->get_result();

        if($checkEmail->num_rows > 0){
            $_SESSION['register_error'] = "Email is already registered"; // store error message for display
            $_SESSION['active_form'] = "register"; // to handle page switching
        }else {
            // $conn->query("INSERT INTO users (name, email, password, role) VALUES('$name', '$email', '$password', '$role')");

            // or 

            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $password, $role);
            $stmt->execute();
        }

        header("Location: index.php");
        exit();
    }
?>