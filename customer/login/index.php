<?php
include('../include/dbConnection.php');

if (isset($_SESSION['buyreviewcustomer'])) {
    header("Location:../support_ticket/");
}

if (isset($_POST['save'])) {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($connection, trim($_POST['email']))  : "";
    $passwordInput = isset($_POST['password']) ? $_POST['password'] : "";

    $customer = mysqli_query($connection, "SELECT `id`, `password` FROM `customer` WHERE `email`='" . $email . "' AND `delete_flag` = '0'") or die(mysqli_error($connection));

    $count = mysqli_num_rows($customer);

    if ($count > 0) {
        $row = mysqli_fetch_array($customer);
        $hashedPassword = $row['password'];

        if (password_verify($passwordInput, $hashedPassword)) {
            $_SESSION['buyreviewcustomer'] = $row['id'];
            // $_SESSION['success'] = "Login Successfully";
            // header("Location:../support_ticket/");
        } else {
            $errors = "Invalid Email OR Password";
        }
    } else {
        $errors = "Invalid Email OR Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="//cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../css/styles.css" />
    <!-- Layout config Js -->
    <script src="../../assets/js/layout.js"></script>
    <!-- Icons Css -->
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css">
    <style>
            .error
            {
                color: red;
            }
        </style>
</head>

<body class="h-screen lg:flex-row flex flex-col px-5 lg:p-0">
    <div class="flex lg:hidden flex-col gap-3 items-center justify-center basis-1/4">
        <img src="../../assets/website-images/logo_small.svg" />
        <h1 class="text-3xl font-semibold">Log In</h1>
    </div>
    <div class="basis-1/2 m-5 rounded-lg back-lines place-items-center lg:grid hidden">
        <img src="../../assets/website-images/man_on_computer.svg" alt="" />
    </div>
    <div class="w-full basis-3/4 rounded-t-xl lg:m-0 lg:basis-1/2 grid place-items-start py-10 lg:place-items-center back-lines lg:bg-transparent">
        <form method="post" id="frm" class="flex flex-col myform gap-3 w-full px-5 lg:px-0 lg:w-[500px]">
            <h1 class="text-4xl font-semibold text-center md:block hidden">
                Login
            </h1>
            <input type="email" name="email" id="email" placeholder="Email-address" class="border border-gray-800 text-base lg:text-lg lg:px-5 lg:py-3 px-4 py-2 rounded-xl font-sans" />
            <input type="password" name="password" id="password" placeholder="Password" class="border border-gray-800 text-base lg:text-lg lg:px-5 lg:py-3 px-4 py-2 rounded-xl font-sans" />
            <a href="./forgotpassword.html" class="text-right text-base lg:text-lg">Forgot password?</a>
            <button class="px-5 lg:px-10 py-2 lg:py-3 bg-[#464646] text-[#FFDE30] w-fit m-auto text-lg lg:text-xl tracking-tight font-bold rounded-xl" name="save" type="submit">
                Login
            </button>
            <button class="bg-white ring-1 ring-gray-300 shadow-lg py-3 rounded-lg flex justify-center items-center gap-3">
                <img src="../../assets/website-images/google.svg" alt="" /> Login with Google
            </button>
            <p class="text-center">
                Don't have an account?
                <a href="../signup" class="font-semibold">Sign Up</a>
            </p>
        </form>
    </div>

    <script src="../../assets/js/vendors/jquery-3.2.1.min.js"></script>
        <script src="../../assets/libs/simplebar/simplebar.min.js"></script>        
        <script src="../../assets/js/pages/password-addon.init.js"></script>
        <!-- swiper.init js -->
        <script src="../../assets/js/vendors/jquery-validate.js"></script>
        <!-- sweetalert cdn -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            //validation
		$(document).ready(function(){
			$("#frm").validate({
					rules:{
                       
						email:{
							required:true,
							email:true,
						},
						password:{
							required:true,
						},
					},
					messages:{
                        
						email:
                        {
							required:"Email Required",
							email:"Invalid Email",
						},
						password:{
							required:"Password Required",
						},
					},
				  errorElement:"div",
				  errorClass:"error",
					
			});
		});
        </script>
</body>
</html>