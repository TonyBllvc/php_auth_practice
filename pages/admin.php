<?php

    session_start();

    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
        exit();
    }
    
    if($_SESSION['role'] === "user"){
        header("Location: user.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
              --color-clifford: #da373d;
            }
          </style>
</head>
<body class="bg-white">

    <div class="flex flex-col justify-center items-center min-h-[100vh] text-[#333]">
        <div class=" w-full max-w-[680px] flex flex-col justify-center items-center p-7">
            <h1 class="text-5xl my-2"> Welcome, <span class="text-[#7494ec]"> <?= $_SESSION['name']; ?> </span> </h1>
            <p class="text-xl my-2">This is an <span class="text-[#7494ec]">admin</span> page</p>
            <button type="button" class="block my-2 w-[300px] bg-red-400 py-3 text-xl font-semibold text-slate-100 m-auto rounded-lg" onclick="window.location.href='../controllers/logout.php' ">Logout</button>
        </div>
    </div>

</body>
</html>