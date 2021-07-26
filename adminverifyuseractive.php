<?php
	session_start();
    require_once "pdo.php";
	
	$aid = $_SESSION['aid'];
	if ( ! isset($_SESSION['aid']) ) {
		  $_SESSION['error'] = "Missing admin id";
		  session_destroy();
		  header('Location: index.php');
		  return;
	}
	
    $stmt = $pdo->query("SELECT * FROM users where stats = 'active' order by category desc;");
	 
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
			background-color: #b29a86;
		}

		.container-bg2{
			background-color: #DBDBDC;
		}

		.container-bg3{
			background-color: #E7D27C;
		}
		
		
		</style>
    </head>
    <body>
        <div class="logo">
			<a href="adminpage.php">
					<h1>Ringgit%</h1>
			</a>
		</div>
			<div class="two">
				<select name="userpage" onchange="location = this.value;"> 
				 <option value="">Filter</option>
				 <option value="adminverifyuser.php">Show all user</option>
				 <option value="adminverifyuserpeasant.php">Peasants</option>
				 <option value="adminverifyuserduke.php">Duke</option>
				 <option value="adminverifyuserking.php">King</option>
				 <option value="adminverifyuseractive.php">Active</option>
				 <option value="adminverifyuserblock.php">Blocked</option>
				</select> 
			</div>
	   
	   <div class="container">
	   
        <h2>Verify User</h2>
			<div class="container fluid">
			
			<?php
				echo('<div class="complogo">');
						echo('<div class="row">');
						foreach ($rows as $row) {
								
								if($row['category'] == "peasant"){
									$bgcolor = "bg1";
								} else if($row['category'] == "duke"){
									$bgcolor = "bg2";
								} else{
									$bgcolor = "bg3";
								}
									echo('<div class="col-sm-4">');
										echo('<a href="userdetailadmin.php?phone='.$row['phone'].'">');
											echo('<div class="container-'.$bgcolor.'">');
												echo('<div class="container p-3 my-3">');
													echo('<p>Name: ');
													echo($row['name']);
													echo('</p>');
													echo('<p> Email: ');
													echo($row['email']);
													echo('</p>');
													echo('<p>Phone number: ');
													echo($row['phone']);
													echo('</p>');
													echo('<p>Gender: ');
													echo($row['gender']);
													echo('</p>');
													echo('<p>Status: ');
													echo($row['stats']);
													echo('</p>');
													echo('<p>Coins: ');
													echo($row['coinamount']);
													echo('</p>');
												echo('</div>');
											echo('</div>');
										echo('</a>');
									echo('</div>');
						
						}
						echo('</div>');
					
					
				echo('</div>');
				
				?>
				
				
			
			</div>
				
				<p> </p>
				
				<div class="terms">
					<p>*T&C applies</p>
				</div>
				<p> </p>
			</div>
	   </div>
	   
    </body>
</html>