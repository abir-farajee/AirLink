
<?php 
include "db.php";

    session_start();

    if(isset($_SESSION['id']) =="") {
        header("Location: index.html");
    }
   
?>


<?php
			$i=1;
			if(isset($_POST['Submit']))
			{
				$pnr=rand(1000000,9999999);
				$date_of_res=date("Y-m-d");
				$flight_no=$_SESSION['flight_no'];
				$journey_date=$_SESSION['journey_date'];
				$class=$_SESSION['class'];
                $booking_status="PENDING";
                $no_of_pass=$_SESSION['no_of_pass'];
				$total_no_of_meals=0;
				$_SESSION['pnr']=$pnr;

           

				$payment_id=NULL;
				$customer_id=$_SESSION['id'];

        

                $result = mysqli_query($conn, "INSERT INTO ticket_details (ticket_id,date_of_reservation,flight_no,journey_date,class,booking_status,no_of_passengers,payment_id,customer_id) 
                VALUES ('" . $pnr . "','" . $date_of_res . "','" . $flight_no . "','" . $journey_date . "','" . $class . "','" . $booking_status . "','" . $no_of_pass . "','" . $payment_id . "','" . $customer_id . "')");
				
				
				for($i=1;$i<=$no_of_pass;$i++)
				{
                    

					$result = mysqli_query($conn, "INSERT INTO Passengers (passenger_id,ticket_id,name,age,gender,meal_choice) 
                    VALUES ('" . $i . "','" . $pnr . "','" . $_POST['pass_name'][$i-1]. "','" . $_POST['pass_age'] [$i-1]. "','" .$_POST['pass_gender'][$i-1] . "','" . $_POST['pass_meal'] [$i-1]. "')");
			

					if($_POST['pass_meal'][$i-1]=='yes')
						$total_no_of_meals++;

					
				}
				$_SESSION['total_no_of_meals']=$total_no_of_meals;
				

				header("location: payment_details.php");


			}
			else
			{
				echo "Submit request not received";
			}
		?>