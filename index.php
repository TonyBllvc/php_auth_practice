<!-- index.php -->
<?php 
    session_start();

    // example on usage
    // require_once 'database/index.php';    // Get DB connection (sets up DB if needed)
    // require_once 'tables/index.php'; // Load table creation functions
    
    require_once 'init.php';

    // Get the connection (runs DB setup if needed)
    $conn = setupDatabase();

    // define('APP_ROOT', dirname(__DIR__)); 
    // echo APP_ROOT;
    // Set up specific tables by calling functions
    createUsersTable($conn);  // Creates 'users' if not exists
    // createListsTable($conn);  // Creates 'lists' if not exists
    // You can call more functions here if you add them to tables_setup.php
    
    // For this application 
    $errors = [
        'login' => $_SESSION['login_error'] ?? "", //  ?? Null Coalescing Operator.
        "register" => $_SESSION['register_error'] ?? ""
    ];
    $active_form = $_SESSION['active_form'] ?? "login";

    // echo $active_form;
    
    if(isset($_SESSION['email'])){
        if($_SESSION['role'] === "admin"){
            header("Location: pages/admin.php");
        }else if($_SESSION['role'] === "user"){
            header("Location: pages/user.php");
        }
        exit();
    }

    session_unset(); // this removes all session variables, but note that session itself is still active.

    function showError($error){
        return !empty($error) ? "<p class='p-3 bg-[#f8d7da] rounded-md text-base text-red-500 text-center mb-5'> $error </p>" : '';
    }

    function isActiveForm($formName, $activeForm){
        return $formName === $activeForm ? 'block' : 'hidden';
    }

    // Close connection when done
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> An Authentication and Authorization Site</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
              --color-clifford: #da373d;
            }
          </style>
</head>

<body>

    <div
        class="flex justify-center items-center min-h-[100vh] bg-[linear-gradient(to_right,#e2e2e2,#c9d6ff)] text-[#333] ">
        <!-- Use this later for the e-commerce site -->
         <!-- Container -->
        <div class=" mx-4 my-0  ">
            
            <div class=" <?= isActiveForm('login', $active_form) ?> w-full max-w-[480px] p-7 bg-[#fff] rounded-lg shadow-lg" id="login-form">
            <!-- <div class="block w-full max-w-[480px] p-7 bg-[#fff] rounded-lg shadow-lg" id="login-form"> -->

                <form action="controllers/login.php" method="post">
                    <h2 class="text-4xl text-center mb-5 font-semibold"> Login </h2>
                    <?= showError($errors['login']); ?>
                    <input class="w-full p-3 bg-[#eee] rounded-md border-none outline-none focus:outline-[#7494ec] focus:outline-1  text-base text-[#333] mb-5 " type="email" name="email" placeholder="Enter Email" required>
                    <input class="w-full p-3 bg-[#eee] rounded-md border-none outline-none focus:outline-[#7494ec] focus:outline-1  text-base text-[#333] mb-5 " type="password" name="password" placeholder="Enter Password" required>

                    <input class="w-full p-3 bg-[#7494ec] hover:bg-[#6884d3] rounded-md border-none cursor-pointer text-base text-white font-medium mb-5 transition-all duration-500" type="submit" name="login" value="Login">

                    <p class="text-base text-center mb-3"> Don't have an account? <a class="text-[#7494ec] no-underline hover:underline" href="#"  onclick="showForm('register-form', 'login-form')" > Register</a></p>
                </form>

            </div>
            
            <div class=" <?= isActiveForm('register', $active_form) ?> w-full max-w-[480px] p-7 bg-[#fff] rounded-lg shadow-lg" id="register-form">

                <form action="controllers/register.php" method="post">
                    <h2 class="text-4xl text-center mb-5 font-semibold"> Register </h2>
                    <?= showError($errors['register']); ?>
                    <input class="w-full p-3 bg-[#eee] rounded-md border-none outline-none focus:outline-[#7494ec] focus:outline-1  text-base text-[#333] mb-5 " type="text" name="name" placeholder="Enter Full Name" required>
                    <input class="w-full p-3 bg-[#eee] rounded-md border-none outline-none focus:outline-[#7494ec] focus:outline-1  text-base text-[#333] mb-5 " type="email" name="email" placeholder="Enter Email" required>
                    <input class="w-full p-3 bg-[#eee] rounded-md border-none outline-none focus:outline-[#7494ec] focus:outline-1  text-base text-[#333] mb-5 " type="password" name="password" placeholder="Enter Password" required>

                    <select class="w-full p-3 bg-[#eee] rounded-md border-none outline-none focus:outline-[#7494ec] focus:outline-1  text-base text-[#333] mb-5 " name="role" required>
                        <option value=""> -- Select Role--</option>
                        <option value="User"> User</option>
                        <option value="Admin"> Admin </option>
                    </select>

                    <input class="w-full p-3 bg-[#7494ec] hover:bg-[#6884d3] rounded-md border-none cursor-pointer text-base text-white font-medium mb-5 transition-all duration-500" type="submit" name="register" value="Register">

                    <p class="text-base text-center mb-3"> Have an account already? <a class="text-[#7494ec] no-underline hover:underline" href="#" onclick="showForm('login-form', 'register-form')"> Login</a></p>
                </form>

            </div>

        </div>
    </div>


    <script src="script.js"></script>
    
</body>

</html>