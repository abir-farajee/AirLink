
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




  <form action="payment.php" method="post">
			<h3>ENTER THE PAYMENT DETAILS</h3>
			<h3><u>Payment Summary</u></h3>
            </div>
			<?php
				$flight_no=$_SESSION['flight_no'];
				$journey_date=$_SESSION['journey_date'];
				$no_of_pass=$_SESSION['no_of_pass'];
				$total_no_of_meals=$_SESSION['total_no_of_meals'];
				$payment_id=rand(100000000,999999999);
				$pnr=$_SESSION['pnr'];
				$_SESSION['payment_id']=$payment_id;
				$payment_date=date('Y-m-d'); 
				$_SESSION['payment_date']=$payment_date;


				if($_SESSION['class']=='Economy')
				{	
					$result = mysqli_query($conn, "SELECT price_economy FROM Flight_Details where flight_no='" . $flight_no . "' and departure_date='" . $journey_date . "'");
                    $row = mysqli_fetch_array($result);
                    $ticket_price= $row['price_economy'];
				}
				else if($_SESSION['class']=='Business')
				{
					$result = mysqli_query($conn, "SELECT price_business FROM Flight_Details where flight_no='" . $flight_no . "' and departure_date='" . $journey_date . "'");
                    $row = mysqli_fetch_array($result);
                    $ticket_price= $row['price_business'];
				}
				
				$total_ticket_price=$no_of_pass*$ticket_price;
				$total_meal_price=250*$total_no_of_meals;
				
				$total_discount=0;
				$total_amount=$total_ticket_price+$total_meal_price+$total_discount;
                $_SESSION['total_amount']=$total_amount;
                ?>

				<table>
				<tr>
				<td >Base Fare, Fuel and Transaction Charges (Fees & Taxes included):</td>
				<td > <?php echo "$total_ticket_price";?></td>
				</tr>

				<tr>
				<td >Meal combo price:</td>
				<td > <?php echo "$total_meal_price";?></td>
				</tr>

	
				<tr>
				<td >Discount:</td>
				<td > <?php echo "$total_discount";?></td>
				</tr>


                <tr>
				<td >Total:</td>
				<td > <?php echo "$total_amount";?></td>
				</tr>


				</table>
                <br>
				<p style="margin-left:50px">Your Payment/Transaction ID is <strong><?php echo "$payment_id";?>.</strong> Please note it down for future reference.</p>

				
			<table cellpadding="5" style='margin-left: 50px'>
				<tr>
					<td class="fix_table"><strong>Enter the Payment Mode:-</strong></td>
				</tr>
				<tr>
					<td class="fix_table"><i class="fa fa-credit-card" aria-hidden="true"></i> Credit Card <input type="radio" name="payment_mode" value="credit card" checked></td>
					<td class="fix_table"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Debit Card <input type="radio" name="payment_mode" value="debit card"></td>
					<td class="fix_table"><i class="fa fa-desktop" aria-hidden="true"></i> Net Banking <input type="radio" name="payment_mode" value="net banking"></td>
				</tr>
			</table>
			<br>
			
            <button class="button button2" type="submit" name="Pay_Now"> <i class="fa fa-plane" aria-hidden="true"></i> Pay Now</button>
		</form>

















<?php
        
    }
   }
?>
</body>
</html>