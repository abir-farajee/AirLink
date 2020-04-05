
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

  <?php
			$no_of_pass=$_SESSION['no_of_pass'];
			$class=$_SESSION['class'];
			$count=$_SESSION['count'];
			$flight_no=$_POST['select_flight'];
            $_SESSION['flight_no']=$flight_no;
            ?>
</div>

<form class="form-inline" action="passenger_details.php" method="post">
<?php
while($count<=$no_of_pass)
			{
                ?>
                
                 <table >
                
                 <tr>
                PASSENGER <?php echo $count ;?>
               
               </tr>
             <tr>
                <th> Passenger Name  </th>
                <th> Age </th>
                <th> Gender  </th>
                <th> Inflight Meal </th>
               
               </tr>


                <tr>
                <td><input type="text"  placeholder="Passenger Name" name="pass_name[]"></td>
                <td><input type="text"  placeholder="Age" name="pass_age[]"></td>
                <td>     
                <select  name="pass_gender[]">
                       <option value="Male">Male</option>
        <option value="Female">Female</option>
      
    </select></td>
                <td>    
      <select  name="pass_meal[]">
      <option value="yes">Yes</option>
      <option value="no">No</option>
      
    </select></td>
              
       </tr>

      
       </table>
      
      <?php
        $count=$count+1;
         }
         ?>


<button class="button button2" type="submit" name="Submit"> <i class="fa fa-plane" aria-hidden="true"></i> Book Flight Ticket</button>
    </form>

<?php
        
         }
        }
?>
</body>
</html>