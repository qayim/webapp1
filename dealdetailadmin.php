<?php
	session_start();
    require_once "pdo.php";
	
	$_SESSION['did'] = $_GET['did'];
	$adminid = $_SESSION['aid'];
	$dealid = $_SESSION['did'];
	
	if ( ! isset($_SESSION['aid']) ) {
		  $_SESSION['error'] = "Missing admin id";
		  session_destroy();
		  header('Location: index.php');
		  return;
	}
	
	$stmt = $pdo->prepare("SELECT * FROM deal where did = :did");
		$stmt->execute(array(":did" => $_GET['did']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$dcomment = htmlentities($row['dcomment']);
		$dactivate = htmlentities($row['dactivate']);
		$dverify = htmlentities($row['dverify']);
	
		if ( ! isset($_GET['did']) ) {
		  $_SESSION['error'] = "Missing deal id";
		  header('Location: dealdeatiladmin.php');
		  return;
		} else if ( ! isset($_SESSION['aid']) ) {
		  $_SESSION['error'] = "Missing admin id";
		  header('Location: adminlogin.php');
		  return;
		}
		if(isset($_POST['insert'])){
			$sql = "UPDATE deal SET dcomment = :dcomment, dactivate = :dactivate, aid = :aid, dverify = :dverify WHERE did = :did";
            $stmts = $pdo->prepare($sql);
            $stmts->execute(array(
                ':dcomment' => htmlentities($_POST['dcomment']),
				':dactivate' => htmlentities($_POST['dactivate']),
				':dverify' => htmlentities($_POST['dverify']),
				':did' => $dealid,
				':aid' => $adminid,	
            ));
			header('Location: dealdetailadmin.php?did='.$dealid.'');
			return;
		}
		
		if ( $row === false ) {
			$_SESSION['error'] = 'Bad value for deal id';
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
												echo('<p>Owner phone: ');
												echo($row['phone']);
												echo('</p>');
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
				
			<div class="activate">
				<form method="POST">
				   <p> </p>
									
									<p class="activate">Activate deal: </p>
										<input type="radio" id="active" name="dactivate" <?=$dactivate=="active" ? "checked" : ""?> value="active" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="active">Activate</label>
										  <input type="radio" id="deactive" name="dactivate" <?=$dactivate=="deactive" ? "checked" : ""?> value="deactive" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="deactive">Deactivate</label>	
									<p> </p>
	
									<p class="activate">Verify deal: </p>
										<input type="radio" id="pending" name="dverify" <?=$dverify=="pending" ? "checked" : ""?> value="pending" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="pending">Pending</label>
										<input type="radio" id="rejected" name="dverify" <?=$dverify=="rejected" ? "checked" : ""?> value="rejected" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="rejected">Rejected</label>	
										<input type="radio" id="approve" name="dverify" <?=$dverify=="approve" ? "checked" : ""?> value="approve" style="height:35px; width:35px; vertical-align: middle;">
										  <label for="approve">Approve</label>	
									<p> </p>
									
									<p> </p>
										<p>Comment:</p>
										<input type="text" name="dcomment" value="<?= $dcomment ?>">
									<p> </p>
				<input type="submit" name="insert"  class="btn btn-info btn-lg" value="Submit">
				<form>
			</div>
				
			
			</div>
				
				<p> </p>
				
	   </div>
	   
    </body>
</html>