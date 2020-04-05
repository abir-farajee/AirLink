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
 
    <h3>Search Ticket</h3>
    <form class="form-inline" action="book_ticket.php" method="post">
      
      <input type="text"  placeholder="From.." name="from">
     
      <input type="text"  placeholder="To.." name="to">
   
      <input type="date"  placeholder="Depart Date" name="dep_date">
     
      <input type="number"  placeholder="Number of Passenger" name="passngr_no">
      
      <select  name="class">
      <option value="Business">Business</option>
      <option value="Economy">Economy</option>
      
    </select>
  
      <button type="submit" name="Search">Submit</button>
    </form>
  </div>


  <?php
			if (isset($_POST['Search'])) {
        include "db.php";

        $from = mysqli_real_escape_string($conn, $_POST['from']);
        $to = mysqli_real_escape_string($conn, $_POST['to']);
        $dep_date = mysqli_real_escape_string($conn, $_POST['dep_date']);
        $no_of_pass = mysqli_real_escape_string($conn, $_POST['passngr_no']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);

					$_SESSION['no_of_pass']=$no_of_pass;
					$_SESSION['class']=$class;
					$count=1;
					$_SESSION['count']=$count;
          $_SESSION['journey_date']=$dep_date;
          
					if($class=="Business")
					{
						$result = mysqli_query($conn, "SELECT flight_no,from_city,to_city,departure_date,departure_time,arrival_date,arrival_time,price_business
            FROM Flight_Details WHERE from_city='" .$from. "' AND to_city='" .$to. "' AND departure_date='" .$dep_date. "' AND seats_business >='" .$no_of_pass. "' ORDER BY  departure_time");
              if(mysqli_num_rows($result)>0){
                ?>
              
              <form action="booking_proccess.php" method="POST">
            <table >
             <tr>
                <th> Flight No  </th>
                <th> From </th>
                <th> To  </th>
                <th> Departure Date </th>
                <th> Arrival Date </th>
                <th> Departure Time </th>
                <th> Arrival Timee </th>
                <th> Price Business </th>
               
              
                </tr>
            
            
                <?php while($row=mysqli_fetch_array($result)){?>
            
                <tr>
                <td><?php  echo  $row['flight_no'] ;?></td>
                <td><?php  echo $row['from_city']  ;?></td>
                <td> <?php echo $row['to_city'] ;?></td>
                <td><?php echo $row['departure_date']  ;?></td>
                <td><?php echo $row['arrival_date'] ;?></td>
                <td> <?php echo $row['departure_time'] ;?></td>
                <td><?php echo $row['arrival_time'] ;?></td>
                <td><?php echo $row['price_business'] ;?></td>
                <td><input type="radio"  value="<?php  echo  $row['flight_no'] ;?>"name="select_flight"> </td>
       </tr>
                <?php } ?>
            
                </table>
                <button class="button button2" type="submit" name="Select"> <i class="fa fa-plane" aria-hidden="true"></i> Book Flight Ticket</button>
                </form>
               
    <?php
          }
        }
        ?>
<?php


if($class=="Economy")
					{
						$result = mysqli_query($conn, "SELECT flight_no,from_city,to_city,departure_date,departure_time,arrival_date,arrival_time,price_economy
            FROM Flight_Details WHERE from_city='" .$from. "' AND to_city='" .$to. "' AND departure_date='" .$dep_date. "' AND seats_economy >='" .$no_of_pass. "' ORDER BY  departure_time");
              if(mysqli_num_rows($result)>0){
                ?>
                  <form action="booking_proccess.php" method="POST">
            <table >
             <tr>
             <th> Flight No  </th>
                <th> From </th>
                <th> To  </th>
                <th> Departure Date </th>
                <th> Arrival Date </th>
                <th> Departure Time </th>
                <th> Arrival Timee </th>
                <th> Price Economy </th>
               
              
                </tr>
            
            
                <?php while($row=mysqli_fetch_array($result)){?>
            
                <tr>
                <td><?php  echo  $row['flight_no'] ;?></td>
                <td><?php  echo $row['from_city']  ;?></td>
                <td> <?php echo $row['to_city'] ;?></td>
                <td><?php echo $row['departure_date']  ;?></td>
                <td><?php echo $row['arrival_date'] ;?></td>
                <td> <?php echo $row['departure_time'] ;?></td>
                <td><?php echo $row['arrival_time'] ;?></td>
                <td><?php echo $row['price_economy'] ;?></td>
                <td><input type="radio"  value="<?php  echo  $row['flight_no'] ;?>"name="select_flight"> </td>
       </tr>
                <?php } ?>
            
                </table>
                <button class="button button2" type="submit" name="Select"> <i class="fa fa-plane" aria-hidden="true"></i> Book Flight Ticket</button>
                </form>


    <?php
          }
        }
        ?>



<?php
      }
        
						
    ?>
    
 


</body>
</html>