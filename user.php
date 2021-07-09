<?php
	session_start();
    require_once "pdo.php";
	
	$phone = $_SESSION['phone'];
	
		if ( ! isset($_SESSION['phone']) ) {
		  $_SESSION['error'] = "Missing phone number";
		  header('Location: deal.php');
		  return;
		}
	
		$stmt = $pdo->prepare("SELECT * FROM users where phone = :phone");
		$stmt->execute(array(":phone" => $phone));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if ( $row === false ) {
			$_SESSION['error'] = 'Bad value for phone';
			header( 'Location: deal.php' ) ;
			return;
		}

		// message if error
		if ( isset($_SESSION['error']) ) {
			echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
			unset($_SESSION['error']);
		}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Muhammad Qayim bin Norizan</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" 
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		<script 
			src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
		</script>
		<script 
			src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
		</script>
		<script 
			src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
		</script>
		<style>
		.logo{
			font-family: "Trebuchet MS", sans-serif;
			padding-top: 20px;
			padding-left: 25px;
		}
		h2{
			padding-top: 5px;
			padding-left: 25px;
			color: #80CDF9;
		}
		.two{
			text-align: right;
			padding-right: 25px;
		}
		
		.btn{
			width: 250px;
		}
		
		p{
			text-align: center;
		}
		.complogo{
			text-align: center;
		}
		.fa-amazon{
			color: black;
		}
		.comptagline{
			font-size: 30px;
			font-weight: lighter;
		}
		.dealdesc{
			font-size: 31px;
			padding: 5px;
		}
		.promocode{
			font-size: 36px;
			font-weight: bold;
			
		}
		.terms{
			font-size: 10px;
			padding-top: 30px;
		}
		.share{
			text-align: center;
			font-size: 20px;
		}
		.icons{
			text-align: center;
		}
		
		.row{
			font-size: 20px;
		}
		
		.dcode{
			font-weight: bold;
			font-size: 30px;
		}
		
		
		</style>
    </head>
    <body>
		<table style="width: 100%">
		<tr>
		<th>
			<div class="logo">
				<a href="deal.php">
							<h1>Ringgit%</h1>
							<?php 
              if ( isset($_SESSION['success']) ) {
                 echo('<p style="color: red;">'.htmlentities($_SESSION['success'])."</p>\n");
                 unset($_SESSION['success']);
              }
        ?>
				</a>
		    </div>
		</th>
		
		
		<th>
		<p> </p>
	   <div class="two">
			<a href="edituserdetail.php" class="btn btn-primary btn-lg">Edit user details</a>
			<a href="userdealcreatedpage.php" class="btn btn-primary btn-lg">Deal details</a>
			<p> </p>
			<a href="rewardpage.php" class="btn btn-primary btn-lg">Redeem prizes</a>
			<a href="referalcoderedemption.php" class="btn btn-primary btn-lg">Redeem referal code</a>
	   </div>
	   </th>
	   
	   </tr>
	   <td>
	   <h2><i class="fas fa-coins"></i> Coins: 
				<?php 
						echo(" ".$row['coinamount']." ");
				?>
		</h2>
	    </table>
		</td>
	   <div class="container">
	   
        
			<div class="container fluid">
			
			<?php
				echo('<div class="complogo">');
				
					
					//this is to get the logo/pic from database
					//<?php echo(htmlentities($_SESSION["dlogo"])) 
					
					//to get all of the images in database
						echo('<div class="row">');
						//foreach ($rows as $row) {
								
									//echo('<div class="col-sm-4">');
										echo('<h2> ');
												echo($row['email']);
										echo('</h2>');
											echo('<div class="container">');
												echo('<p>Name: ');
												echo($row['name']);
												echo('</p>');
												echo('<p> Phone number: ');
												echo($row['phone']);
												echo('</p>');
												echo('<p>Email: ');
												echo($row['email']);
												echo('</p>');
												echo('<p>');
												echo('Referal code: ');
												echo('</p>');
												echo('<p class="dcode">');
												echo($row['referalcode']);
												echo('</p>');
												echo('<p>Country: ');
												echo($row['country']);
												echo('</p>');
												echo('<p>Address: ');
												echo($row['address']);
												echo('</p>');
												echo('<p>Postal: ');
												echo($row['postal']);
												echo('</p>');
												echo('<p>Category: ');
												echo($row['category']);
												echo('</p>');
											echo('</div>');
										
									//echo('</div>');
						//}
						echo('</div>');
					
					
				echo('</div>');
				
				?>
				
				
			
			</div>
				
				<p> </p>
				<p class="share">Share:</p> 
				<div class="icons">
				<a href=""><i class="fab fa-whatsapp" style="font-size:50px;"></i></a>
				<a href=""><i class="fab fa-facebook" style="font-size:50px;"></i></a>
				<a href=""><i class="fab fa-twitter" style="font-size:50px;"></i></a>
				<a href=""><i class="fab fa-facebook-messenger" style="font-size:50px;"></i></a>
				<a href=""><i class="fab fa-instagram" style="font-size:50px;"></i></a>
				<a href=""><i class="fa fa-envelope" style="font-size:50px; aria-hidden="true" ></i></a>
				</div>
				<div class="terms">
					<p>*T&C applies</p>
				</div>
					
					
				
				<?php
					//foreach ($rows as $row) {
					//	echo "<tr><td>";
					//	echo($row['make']);
					//	echo"</td><td>";
					//	echo($row['year']);
					//	echo "</td><td>";
					//	echo($row['mileage']);
					//	echo "</td><tr>";
					//}
				?>	
		
				<p> </p>
			</div>
	   </div>
	   
    </body>
</html>