<?php 
//$Connection = mysqli_connect("localhost","root","","db_name");

$Connection = mysqli_connect("localhost","root","","userdb");

 if (mysqli_connect_errno()) {
    die("Database connection failed". mysqli_connect_error());
 }else{
    //echo"Connection sucessful.";
 }


?>