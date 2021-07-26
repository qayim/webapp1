<?php
	session_start();
    require_once "pdo.php";
	
	if (isset($_SESSION["phone"])){
		
		$phone = $_SESSION["phone"];
	
		if (isset($_POST['insert'])) {
			if (!isset($_POST['search'])) {
				$_SESSION['error'] = "Search missing";
				header("Location: dealsearch.php");
				return;
			} else{
				$stmt = $pdo->prepare("SELECT * FROM deal WHERE dactivate = 'active' AND dname LIKE :dname ORDER BY damount desc;");
				$stmt->execute(array(
					':dname' => '%'.htmlentities($_POST['search']).'%',
				));
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		}
	} 
	
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Muhammad Qayim bin Norizan</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" 
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  
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
			width: 100%;
			text-align: left;
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
		
		.btn{
			height: 40px;
			width: 200px;
			padding: 5px;
		}
		</style>
    </head>
    <body>
        <p> </p>
		<table>
		<tr>
			<th>
				<div class="logo">
				<h1> <a href="deal.php">Ringgit%</a> <a href="user.php"><i class="fas fa-user"></i></a></h1>
				</div>
			</th>
			
		</tr>
		<tr>
			<th>
			<div class="two">
				<form method="POST">
                        <input type="text" placeholder="Search" name="search" id="search" size="23">
						<p> </p>

                        <input type="submit" name="insert"  class="btn btn-info btn-lg" value="Search">
						
						<p> </p>
                    </form>
			</div>
			</th>
		</tr>
		</table>	
                    
					
		<div class="container">
	   
        <h2>Deal name</h2>
			<div class="container fluid">
			<?php 
					  if ( isset($_SESSION['error']) ) {
						 echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
						 unset($_SESSION['error']);
					  }
				?>
			<?php
			if(isset($rows)){
				echo('<div class="complogo">');
				
					
					//this is to get the logo/pic from database
					//<?php echo(htmlentities($_SESSION["dlogo"])) 
					
					//to get all of the images in database
						echo('<div class="row">');
						foreach ($rows as $row) {
								
									echo('<div class="col-sm-4">');
										echo('<a href="dealdetails.php?did='.$row['did'].'">');
											echo('<div class="container p-3 my-3 bg-light">');
												echo('<img src="uploads/');
												echo($row['dlogo']);
												echo('" class="complogo" height="200px" width="200px">');
												echo('<p>Name: ');
												echo($row['dname']);
												echo('</p>');
												echo('<p> Tagline: ');
												echo($row['dtagline']);
												echo('</p>');
												//echo('<p>Description: ');
												//echo($row['ddesc']);
												//echo('</p>');
												echo('<p>Promo code: ');
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
										echo('</a>');
									echo('</div>');
						
						}
						echo('</div>');
					
					
				echo('</div>');
			} else{
				echo('<p>Search not found</p>');
			}			
				?>
				
				
			
			</div>
        </div>
		<p> </p>
    </body>
</html>

