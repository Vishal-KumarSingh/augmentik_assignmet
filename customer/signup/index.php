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
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body class="h-screen lg:flex-row flex flex-col px-5 lg:p-0">
  <div class="flex lg:hidden flex-col gap-3 items-center justify-center basis-1/4">
    <img src="../../assets/website-images/logo_small.svg" />
    <h1 class="text-3xl font-semibold">Sign Up</h1>
  </div>
  <div class="basis-1/2 m-5 rounded-lg back-lines place-items-center lg:grid hidden">
    <img src="../../assets/website-images/man_on_computer.svg" alt="" />
  </div>
  <div class="w-full basis-3/4 rounded-t-xl lg:m-0 lg:basis-1/2 grid place-items-start py-10 lg:place-items-center back-lines lg:bg-transparent">
    <form id="frm" action="" class="flex flex-col myform gap-3 w-full px-5 lg:px-0 lg:w-[500px]">
      <h1 class="text-4xl font-semibold text-center md:block hidden">
        Sign Up
      </h1>
      <input type="text" name="fname" id="fname" placeholder="First Name" class="border border-gray-800 text-base lg:text-lg lg:px-5 lg:py-3 px-4 py-2 rounded-xl font-sans" />
      <input type="text" name="lname" id="lname" placeholder="Last Name" class="border border-gray-800 text-base lg:text-lg lg:px-5 lg:py-3 px-4 py-2 rounded-xl font-sans" />
      <input type="email" name="email" id="email" placeholder="Email-address" class="border border-gray-800 text-base lg:text-lg lg:px-5 lg:py-3 px-4 py-2 rounded-xl font-sans" />
      <input type="tel" name="phone" id="phone" placeholder="Mobile Number" class="border border-gray-800 text-base lg:text-lg lg:px-5 lg:py-3 px-4 py-2 rounded-xl font-sans" />
      <input type="password" name="password" id="password" placeholder="Password" class="border border-gray-800 text-base lg:text-lg lg:px-5 lg:py-3 px-4 py-2 rounded-xl font-sans" />
      <div class="flex gap-3">
        <!-- <input type="checkbox" name="ts" id="ts" />
        <p>I accept the Terms of Service and Privacy Policy</p> -->
      </div>
      <button id="submitBtn" class="px-5 lg:px-10 py-2 lg:py-3 bg-[#464646] text-[#FFDE30] w-fit m-auto text-lg lg:text-xl tracking-tight font-bold rounded-xl" type="submit">
        Submit
      </button>
      <button class="bg-white ring-1 ring-gray-300 shadow-lg py-3 rounded-lg flex justify-center items-center gap-3">
        <img src="../../assets/website-images/google.svg" alt="" /> Sign Up with Google
      </button>
      <p class="text-center">
        Already have an account? <a href="../login" class="font-semibold">Login</a>
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
    $(document).ready(function() {
      $("#frm").validate({
        rules: {

          email: {
            required: true,
            email: true,
            maxlength: 35,
          },
          password: {
            required: true,
            maxlength: 25,
          },
          fname: {
            required: true,
            maxlength: 20,
          },
          lname: {
            required: true,
            maxlength: 20,
          },
          phone: {
            required: true,
            maxlength: 15,
          },
        },
        messages: {

          email: {
            required: "Email Required",
            email: "Invalid Email",
            maxlength: 'Email should not exceed 35 characters',
          },
          password: {
            required: "Password Required",
            maxlength: 'password should not exceed 25 characters',
          },
          fname: {
            required: "Enter First Name",
            maxlength: 'First Name should not exceed 20 characters',
          },
          lname: {
            required: "Enter Last Name",
            maxlength: 'Last Name should not exceed 20 characters',
          },
          phone: {
            required: "Enter Mobile Number",
            maxlength: 'Enter correct mobile number',
          },
        },
        errorElement: "div",
        errorClass: "error",
        errorPlacement: function(error, element) {
          error.insertAfter(element);
        },

      });
      $("#submitBtn").click(function(e) {
        e.preventDefault();
        if ($("#frm").valid()) {
          var formData = $("#frm").serialize();
          $.ajax({
            type: "POST",
            url: "../ajax/signup_validate.php",
            data: formData,
            success: function(response) {
              messageShow(response);
            },
            error: function(error) {
              console.log("Error:", error);
            }
          });
        }
      });
    });

    function messageShow(response) {
      Swal.fire({
        title: 'Signing Up',
        html: 'Please wait...',
        showConfirmButton: false,
        allowOutsideClick: false,
        willOpen: () => {
          Swal.showLoading();
        },
        didOpen: () => {
          setTimeout(() => {
            Swal.close();
            Swal.fire({
              icon: response.icon,
              title: response.title,
              text: response.message,
              confirmButtonText: 'OK',
              allowOutsideClick: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = response.location; 
              }
            });
          }, 2000);
        }
      });

    }
  </script>

</body>

</html>