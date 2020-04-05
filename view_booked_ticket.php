
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

<?php
              
            }
         }
        
?>

<div class="logo">
  <img src="images/logo.png" alt="">
</div>
  <div class="header">

Upcoming Flights

  </div>


  <?php
			$todays_date=date('y-m-d');

			
			$customer_id=$_SESSION['id'];
            $status="CONFIRMED";
			
            $query ="SELECT ticket_id,date_of_reservation,flight_no,journey_date,class,booking_status,no_of_passengers,payment_id
            FROM ticket_details WHERE customer_id='" .$customer_id. "'AND journey_date>='" .$todays_date. "' ORDER BY  journey_date";
             $result= mysqli_query($conn, $query);  
             if(mysqli_num_rows($result) > 0)  
             {  
                 ?>
                
            <table >
              <tr>
                <th> Ticket ID</th>
                <th> Flight No  </th>
                <th> Date of Reservation </th>
                <th> Journey Date </th>
                <th> Class</th>
                <th> Booking Status</th>
                <th> No. of Passengers</th>
                <th> Payment ID </th>
               
       
                </tr>
            
            
                <?php while($row=mysqli_fetch_array($result)){?>
            
                <tr>
                <td><?php  echo  $row['ticket_id'] ;?></td>
                <td><?php echo $row['flight_no']  ;?></td>
                <td><?php echo $row['date_of_reservation'] ;?></td>
                <td> <?php echo $row['journey_date'] ;?></td>
                <td><?php echo $row['class'] ;?></td>
                <td><?php echo $row['booking_status'] ;?></td>
                <td><?php echo $row['no_of_passengers'] ;?></td>
                <td><?php echo $row['payment_id'] ;?></td>
                
       </tr>
                <?php } ?>
            
                </table>


                <?php
                }
                else
                {
                    ?>
<h2>No Upcoming Flight</h2>

<?php
                }

                ?>


<div class="header">

Completed Flights

  </div>

<?php
			$todays_date=date('y-m-d');

			
			$customer_id=$_SESSION['id'];
            $status="CONFIRMED";
			
            $query ="SELECT ticket_id,date_of_reservation,flight_no,journey_date,class,booking_status,no_of_passengers,payment_id
            FROM ticket_details WHERE customer_id='" .$customer_id. "'AND journey_date<'" .$todays_date. "' ORDER BY  journey_date";
             $result= mysqli_query($conn, $query);  
             if(mysqli_num_rows($result) > 0)  
             {  
                 ?>
                
            <table >
              <tr>
                <th> Ticket ID</th>
                <th> Flight No  </th>
                <th> Date of Reservation </th>
                <th> Journey Date </th>
                <th> Class</th>
                <th> Booking Status</th>
                <th> No. of Passengers</th>
                <th> Payment ID </th>
               
       
                </tr>
            
            
                <?php while($row=mysqli_fetch_array($result)){?>
            
                <tr>
                <td><?php  echo  $row['ticket_id'] ;?></td>
                <td><?php echo $row['flight_no']  ;?></td>
                <td><?php echo $row['date_of_reservation'] ;?></td>
                <td> <?php echo $row['journey_date'] ;?></td>
                <td><?php echo $row['class'] ;?></td>
                <td><?php echo $row['booking_status'] ;?></td>
                <td><?php echo $row['no_of_passengers'] ;?></td>
                <td><?php echo $row['payment_id'] ;?></td>
                
       </tr>
                <?php } ?>
            
                </table>


                <?php
                }
                else
                {
                    ?>
<h2>No Completed Flight</h2>

<?php
                }

                ?>









</body>
</html>