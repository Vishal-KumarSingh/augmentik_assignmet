<?php  
include('../include/dbConnection.php');
// unset($_SESSION['byw22Admin']);
if(isset($_SESSION['buyreviewcustomer']))
{
    unset($_SESSION['buyreviewcustomer']);
}
header('location:../login/');
?>