
<?php 
include "db.php";

    session_start();

    if(isset($_SESSION['id']) =="") {
        header("Location: index.html");
    }
   
?>


<?php
			if(isset($_POST['Pay_Now']))
			{
				$no_of_pass=$_SESSION['no_of_pass'];
				$flight_no=$_SESSION['flight_no'];
				$journey_date=$_SESSION['journey_date'];
				$class=$_SESSION['class'];
				$pnr=$_SESSION['pnr'];
				$payment_id=$_SESSION['payment_id'];
				$total_amount=$_SESSION['total_amount'];
				$payment_date=$_SESSION['payment_date'];
				$payment_mode=$_POST['payment_mode'];				

			
				if($class=='Economy')
				{
                    $result = mysqli_query($conn, "UPDATE flight_details SET seats_economy=seats_economy-'$no_of_pass' WHERE flight_no='$flight_no' AND departure_date='$journey_date'");
                    
                   
				}
				else if($class=='Business')
				{
                    $result = mysqli_query($conn, "UPDATE flight_details SET seats_business=seats_business-'$no_of_pass' WHERE flight_no='$flight_no' AND departure_date='$journey_date'");
                   
				}
			
                
				
					

					$result = mysqli_query($conn, "INSERT INTO payment_details (payment_id,ticket_id,payment_date,payment_amount,payment_mode) 
                    VALUES ('" . $payment_id . "','" . $pnr . "','" . $payment_date . "','" . $total_amount . "','" . $payment_mode . "')");
               
						
						header('location:payment_success.php');
					
			
				
            }
        
		
		?>