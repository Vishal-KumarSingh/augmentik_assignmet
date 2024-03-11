<?php
include('../include/dbConnection.php');

$response = array(
    'title' => 'Error',
    'message' => 'Error, please try later.',
    'icon' => 'warning',
    'location' => '../signup',
);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $result = mysqli_query($connection, "SELECT COUNT(*) as count FROM customer WHERE email = '$email'");
    
    if ($result) {
        $row = mysqli_fetch_array($result);
        $userExists = ($row['count'] > 0);

        if ($userExists) {
            $response['title'] = 'Information';
            $response['message'] = 'User already exists.';
            $response['icon'] = 'info';
            $response['location'] = '../login';
        } else {
            $firstName = isset($_POST['fname']) ? $_POST['fname'] : '';
            $lastName = isset($_POST['lname']) ? $_POST['lname'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $mobile = isset($_POST['phone']) ? $_POST['phone'] : '';
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $customer = mysqli_query($connection, "INSERT INTO customer (`firstName`, `lastName`, `mobile`, `email`, `password`)
                                              VALUES ('$firstName', '$lastName', '$mobile', '$email', '$hashedPassword')") or die(mysqli_error($connection));
            if ($customer) {
                $response['title'] = 'Success';
                $response['message'] = 'You have successfully signed up.';
                $response['icon'] = 'success';
                $response['location'] = '../login';
            }
        }
    }
}
header('Content-Type: application/json');
echo json_encode($response);
?>
