<?php
date_default_timezone_set('Asia/Kolkata');
if(!isset($_SESSION)){
    session_start();
} 
ob_start();
$serverUsename = $_SERVER["HTTP_HOST"] == "localhost" ? "root" : "cblqlkib_pickmyphone";
$serverPassword = $_SERVER["HTTP_HOST"] == "localhost" ? "" : "BNiZw-^jpeB^";
$database = $_SERVER["HTTP_HOST"] == "localhost" ? "buyreview" : "cblqlkib_buyreviewwebsite";
$connection = mysqli_connect("localhost", $serverUsename, $serverPassword) or die("Database Connection Failed.");

if(!$connection)
{
    echo "Database Connection Failed";
    //die("Database Connection Failed : " . mysqli_error($connection));
}
else
{
	mysqli_select_db($connection, $database) or die("Database Selection Failed : " . mysqli_error($connection));
}
?>