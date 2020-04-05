<?php
session_start();

require_once "db.php";

if(isset($_SESSION['id'])!="") {
    header("Location: customer_home.php");
}

if (isset($_POST['signin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    if(strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }  

    $result = mysqli_query($conn, "SELECT * FROM customer WHERE username = '" . $username. "' and password = '" .$password. "'");
   if(!empty($result)){
        if ($row = mysqli_fetch_array($result)) {
         

            $_SESSION['id'] = $row['customer_id'];
          

            header("Location: customer_home.php");
        } 
    }else {
        $error_message = "Incorrect Email or Password!!!";
    }
}
?><!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
    <title> Flight Ticket Management</title>
</head>
<body>

<ul class="ul">
  <li class="li1"><a href="index.html">Home</a></li>
  <li class="li1"><a href="book_ticket.php">Booking</a></li>
  <li class="li1"><a href="#contact">Contact</a></li>
  <li class="li2"><a href="register.php">Register</a></li>
  <li class="li2"><a class="active" href="login.php">Log In</a></li>
  
</ul>

<div class="logo">
  <img src="images/logo.png" alt="">
</div>



<div class="header">
 
    <h3 class="h3">Log In</h3>
    <form class="form-inline" action="login.php" method="POST">
     
      <input type="text"  placeholder="Username" name="username">

      <input type="password"  placeholder="Enter password" name="password">
  
      <button type="submit" name="signin">Proccess</button>
    </form>
  </div>




</body>
</html>