<?php

$showalert = false;
$showError = false;
$showError2 = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbcon.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if username already exists
    $getname= "SELECT * FROM `users` WHERE `username`='$username'";
    $getNameResult = mysqli_query($conn, $getname);
    
    if (mysqli_num_rows($getNameResult) > 0) {
        $showError2 = "Username already exists.";
        
    } else {
        // Check if passwords match
        if ($password === $cpassword) {
             
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `td`) VALUES ('$username', '$hash', current_timestamp())";

            $results = mysqli_query($conn, $sql);

            if ($results) {
                $showalert = true;
            } else {
                $showError = "Failed to create account.";
            }
        } else {
            $showError = "Passwords do not match.";
        }
    }
}

if (isset($_SESSION['loggedin'])  && $_SESSION['loggedin'] == true){
header("location: welcome.php");
};

?>

<!-- Rest of your HTML and PHP code remains unchanged -->





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Sign Up</title>
  </head>
  <body>

  <?php  require('partials/_nav.php')?>
  <?php

  if ($showalert) {
   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You Account has been Created.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  };
  if($showError){
  
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> We are sorry but your passwords do not match.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  };
  if($showError2){
  
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> We are sorry but username already exsits please choose a different one.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  };
  
?>
  <div class="container">

  <h1 class="text-center">Sign Up to our website</h1>
  
    

  <form action="/php/loginsystem/signup.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Your Username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" maxlength="23" class="form-control" id="password" name="password" placeholder="Enter Your Password">
  </div>
  <div class="form-group">
    <label for="cpassword"> Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-Enter Your Password">
    
    <small id="emailHelp" class="form-text text-muted">Make Sure to Use the Same password.</small>
  </div>
 
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form></div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>