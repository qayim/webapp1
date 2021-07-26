<?php
	session_start();
    require_once "pdo.php";
	
	$aid = $_SESSION['aid'];
	
	if ( ! isset($_SESSION['aid']) ) {
		  $_SESSION['error'] = "Missing admin id";
		  header('Location: index.php');
		  return;
		}
    $stmt = $pdo->query("SELECT * FROM share JOIN deal ON (share.did = deal.did);");
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
			<a href="adminpage.php">
					<h1>Ringgit%</h1>
			</a>
		</div>
			<div class="two">
				<select name="dealpage" onchange="location = this.value;"> 
				 <option value="">Filter</option>
				 <option value="adminverifyuser.php">Verify user</option>
				 <option value="adminpage.php">Show all deals</option>
				 <option value="adminpageapprove.php">Show approved deals</option>
				 <option value="adminpagepending.php">Show pending deals</option>
				 <option value="adminpagerejected.php">Show rejected deals</option>
				 <option value="adminreferallist.php">Show referal list</option>
				 <option value="adminreward.php">Show rewards</option>
				 <option value="admincreatereward.php">Create reward</option>
				</select> 
			</div>
	   
	   <div class="container">
	   
        <h2>Deal shared</h2>
			<div class="container fluid">
			
			<?php
				echo('<div class="complogo">');
					echo('<div class="row">');
						foreach ($rows as $row) {
								
									echo('<div class="col-sm-4">');
											echo('<div class="container-bg1">');
												echo('<div class="container p-3 my-3">');
													echo('<p>Share id: ');
													echo($row['sid']);
													echo('</p>');
													echo('<p>Platform: ');
													echo($row['platform']);
													echo('</p>');
													echo('<p>User phone(shared): ');
													echo($row['phone']);
													echo('<p>Deal ID: ');
													echo($row['did']);
													echo('</p>');
													echo('<p>Deal name: ');
													echo($row['dname']);
													echo('</p>');
													echo('<p>Times clicked: ');
													echo($row['popularitycounter']);
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