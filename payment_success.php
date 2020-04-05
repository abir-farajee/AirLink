
<?php 
include "db.php";

    session_start();

    if(isset($_SESSION['id']) =="") {
        header("Location: index.html");
    }
   
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
    <title> Flight Ticket Management</title>
</head>
<body>
<?php
require_once "db.php";
        $id=$_SESSION['id'];

    $query ="SELECT name FROM customer where customer_id=$id ";  
    $result = mysqli_query($conn, $query);  
    if(mysqli_num_rows($result) > 0)  
    {  
        ?>

<ul class="ul">
  <li class="li1"><a  href="index.html">Home</a></li>
  <li class="li1"><a href="book_ticket.php">Booking</a></li>
  <li class="li1"><a href="#contact">Contact</a></li>
  <li class="li2"><a  href="logout.php">Logout</a></li>
  <?php
         while($row = mysqli_fetch_array($result))  
         {  
    ?>  

  <li class="li2"><a class="active" href="customer_home.php">Welcome to AirLink <?php echo $row['name'];?></a></li>


  
</ul>

<div class="logo">
  <img src="images/logo.png" alt="">
</div>
  <div class="header">





<h3>Payment Successful.</h3>







  </div>
  
<?php
        
    }
   }
?>
</body>
</html>