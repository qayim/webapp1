<?php
	session_start();
    require_once "pdo.php";
	
	$_SESSION['did'] = $_GET['did'];
	
	$dealid = $_SESSION['did'];
	
	
	
		if ( ! isset($_GET['did']) ) {
		  $_SESSION['error'] = "Missing deal id";
		  header('Location: deal.php');
		  return;
		}

		$stmt = $pdo->prepare("SELECT * FROM deal where did = :did");
		$stmt->execute(array(":did" => $_GET['did']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
			$_SESSION['error'] = 'Bad value for deal id';
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
			padding-top: 20px;
			padding-left: 25px;
		}
		h2{
			padding-top: 20px;
			color: #80CDF9;
		}
		.two{
			text-align: right;
			padding-right: 25px;
		}
		table, th, td{
			border: 2px solid black;
			align: center;
			padding: 5px;
			margin-left: auto;
			margine-right: auto;
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
        <div class="logo">
            <h1> Ringgit%</h1>
       </div>
	   <div class="two">
			<a href="dealregister.php" class="btn btn-primary btn-lg">Register deal</a>
	   </div>
	   <div class="container">
	   
        <h2>Deal name</h2>
			<div class="container fluid">
			
			<?php
				echo('<div class="complogo">');
				
					
					//this is to get the logo/pic from database
					//<?php echo(htmlentities($_SESSION["dlogo"])) 
					
					//to get all of the images in database
						echo('<div class="row">');
						//foreach ($rows as $row) {
								
									//echo('<div class="col-sm-4">');
										
											echo('<div class="container">');
												echo('<img src="uploads/');
												echo($row['dlogo']);
												echo('" class="complogo" height="200px" width="200px">');
												echo('<p>Name: ');
												echo($row['dname']);
												echo('</p>');
												echo('<p> Tagline: ');
												echo($row['dtagline']);
												echo('</p>');
												echo('<p>Description: ');
												echo($row['ddesc']);
												echo('</p>');
												echo('<p>');
												echo('Promo code: ');
												echo('</p>');
												echo('<p class="dcode">');
												echo($row['dcode']);
												echo('</p>');
												echo('<p>Reward amount: ');
												echo($row['damount']);
												echo($row['dunit']);
												echo('</p>');
												echo('<p>Country supported: ');
												echo($row['dcountrysupp']);
												echo('</p>');
												echo('<p>Valid period: ');
												echo($row['start']);
												echo(' to ');
												echo($row['end']);
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