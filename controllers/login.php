<!-- auth_site/controller/login.php -->
<?php 

    session_start(); // The session_start() function in PHP initializes a new session or resumes an existing one. It is crucial for managing user data across multiple page requests on a website.
    // It allows user to store session data and retrieve session data on and from server
    // Get DB connection (sets up DB if needed)
    // include 'database/index.php'; // require_once will issue a fatal error and the script will terminate immediately.
    
    include '../init.php'; //  Get DB connection (sets up DB if needed)
    
    // Get the connection (runs DB setup if needed)
    $conn = setupDatabase();

    $email = $password = "";

    // $_POST['..'] : This allows use to get data from the post request sent by a html form calling this script.

    if (isset($_POST['login'])){
        $password = $_POST['password'];
        $email = $_POST['email'];

        // $user_account = $conn->query("SELECT * FROM users WHERE email = '$email'"); // Straight forward approach
        
        // or

        // to add SQL injection protection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user_account = $stmt->get_result();

        if($user_account->num_rows > 0){
            $user = $user_account->fetch_assoc(); // retrieve user data
            if(password_verify($password, $user['password'])){
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                
                if($user['role'] === "admin"){
                    header("Location: ../pages/admin.php");
                }else if($user['role'] === "user"){
                    header("Location: ../pages/user.php");
                }
                exit();
            }
        }

        
        $_SESSION['login_error'] = "Incorrect email and password"; // store error message for display
        $_SESSION['active_form'] = "login"; // to handle page switching
        header("Location: ../index.php");
        exit();
    }
?>