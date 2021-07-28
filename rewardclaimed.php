<?php
	session_start();
    require_once "pdo.php";
	
	$phone = $_SESSION['phone'];
	
	if ( ! isset($_SESSION['phone']) ) {
		  $_SESSION['error'] = "Missing phone";
		  header('Location: index.php');
		  return;
		}
    $stmt = $pdo->prepare("SELECT * FROM claim JOIN reward ON(claim.rid = reward.rid) where claim.phone = :phone");
	$stmt->execute(array(":phone" => $phone));
	 
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
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
			padding-top: 20px;
			color: #80CDF9;
		}
		.two{
			text-align: right;
			padding-right: 25px;
		}
		.btn{
			width: 250px;
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
		
		.fa-user{
			color: black;
		}
		
		.container-bg1{
			background-color: #DBDBDC;
		}

		
		</style>
    </head>
    <body>
		<div class="logo">
			<a href="user.php">
					<h1>Ringgit%</h1>
			</a>
		</div>
			
	   <div class="container">
	   
        <h2>Rewards claimed</h2>
			<div class="container fluid">
			
			<?php
				echo('<div class="complogo">');
					echo('<div class="row">');
						foreach ($rows as $row) {
								
									echo('<div class="col-sm-4">');
											echo('<div class="container-bg1">');
												echo('<div class="container p-3 my-3">');
													echo('<p>Name: ');
													echo($row['rname']);
													echo('</p>');
													echo('<p>Type: ');
													echo($row['type']);
													echo('</p>');
													echo('<p>Coin price: ');
													echo($row['coinprice']);
													echo('</p>');
													echo('<p>Status: ');
													echo($row['status']);
													echo('<p>Description: ');
													echo($row['rdesc']);
													echo('</p>');
													echo('<p>Code: ');
													echo($row['rcode']);
													echo('</p>');
													echo('</p>');
												echo('</div>');
											echo('</div>');
									echo('</div>');
						
						}
						echo('</div>');
					
					
				echo('</div>');
				
				?>
				
				
			
			</div>
				
				<p> </p>
			</div>
	   </div>
	   
    </body>
</html>
