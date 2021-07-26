<?php
	session_start();
    require_once "pdo.php";
	
	$_SESSION['phone'] = $_GET['phone'];
	$adminid = $_SESSION['aid'];
	$phone = $_SESSION['phone'];
	if ( ! isset($_SESSION['aid']) ) {
		  $_SESSION['error'] = "Missing admin id";
		  session_destroy();
		  header('Location: index.php');
		  return;
	}
	
	
	$stmt = $pdo->prepare("SELECT * FROM users where phone = :phone");
		$stmt->execute(array(":phone" => $_GET['phone']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$stats = htmlentities($row['stats']);
		$category = htmlentities($row['category']);
	
		if ( ! isset($_GET['phone']) ) {
		  $_SESSION['error'] = "Missing phone";
		  header('Location: adminuserdetail.php');
		  return;
		} else if ( ! isset($_SESSION['aid']) ) {
		  $_SESSION['error'] = "Missing admin id";
		  header('Location: adminlogin.php');
		  return;
		}
		if(isset($_POST['insert'])){
			$sql = "UPDATE users SET stats = :stats, category = :category, aid = :aid WHERE phone = :phone";
            $stmts = $pdo->prepare($sql);
            $stmts->execute(array(
                ':stats' => htmlentities($_POST['stats']),
				':category' => htmlentities($_POST['category']),
				':aid' => $adminid,	
				':phone' => $phone,
            ));
			header('Location: adminuserdetail.php?phone='.$phone.'');
			return;
		}
		
		if ( $row === false ) {
			$_SESSION['error'] = 'Bad value for phone';
			header( 'Location: adminpage.php' ) ;
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
		.activate{
			text-align: center;
			font-size: 20px;
		}
		</style>
    </head>
    <body>
        <div class="logo">
				<a href="adminpage.php">
							<h1>Ringgit%</h1>
				</a>
		</div>
	   <div class="container">
	   
        <h2>User name</h2>
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
												echo('<p>Name: ');
												echo($row['name']);
												echo('</p>');
												echo('<p> Phone: ');
												echo($row['phone']);
												echo('</p>');
												echo('<p>Email: ');
												echo($row['email']);
												echo('</p>');
												echo('<p>Address: ');
												echo($row['address']);
												echo('</p>');
												echo('<p>Country: ');
												echo($row['country']);
												echo('</p>');
												echo('<p>Coin amount: ');
												echo($row['coinamount']);
												echo('</p>');
												echo('<p>Referal code: ');
												echo($row['referalcode']);
												echo('</p>');
												echo('<p>Referal counter: ');
												echo($row['referalcounter']);
												echo('</p>');
												echo('<p>Refer type: ');
												echo($row['refertype']);
												echo('</p>');
											echo('</div>');
										
									//echo('</div>');
						//}
						echo('</div>');
					
					
				echo('</div>');
				
				?>
				
			<div class="activate">
				<form method="POST">
				   <p> </p>
									
									<p class="activate">Status: </p>
										<input type="radio" id="active" name="stats" <?=$stats=="active" ? "checked" : ""?> value="active" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="active">Activate</label>
										  <input type="radio" id="block" name="stats" <?=$stats=="block" ? "checked" : ""?> value="deactive" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="block">Block</label>	
									<p> </p>
	
									<p class="activate">Category: </p>
										<input type="radio" id="king" name="category" <?=$category=="King" ? "checked" : ""?> value="King" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="King">King</label>
										<input type="radio" id="duke" name="dverify" <?=$category=="Duke" ? "checked" : ""?> value="Duke" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="Duke">Duke</label>	
										<input type="radio" id="peasant" name="dverify" <?=$category=="peasant" ? "checked" : ""?> value="Peasant" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="Peasant">Peasant</label>	
									<p> </p>
									
									
				<input type="submit" name="insert"  class="btn btn-info btn-lg" value="Submit">
				<form>
			</div>
				
			
			</div>
				
				<p> </p>
				
	   </div>
	   
    </body>
</html>