<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbanme = "users";


$conn = mysqli_connect($servername,$username,$password,$dbanme);

if (!$conn) {
  
    echo "not connected". mysqli_connect_error();
};

?>