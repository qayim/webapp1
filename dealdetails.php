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
		
		if(isset($_POST['sharedwhatsapp'])){
			if(!isset($_SESSION['phone'])){
				echo('hello');
				header('Location: dealdetails.php?did='.$dealid.'');
			} else{
				//to retrieve the share table to validify if user has shared or not
				$stmtsharews = $pdo->prepare("SELECT * FROM share where did = :did and platform = 'whatsapp' and phone = :phone");
				$stmtsharews->execute(array(":did" => $_GET['did'], ":phone" => $_SESSION['phone'],));
				$rows1 = $stmtsharews->fetch(PDO::FETCH_ASSOC);
				
				$count1 = $stmtsharews->rowCount(); 
				
				if($count1<1){
					$stmtws = $pdo->prepare('INSERT INTO share (platform, did, phone) VALUES (:platform, :did ,:phone);');
				
							$stmtws->execute(array(
								':platform' => "whatsapp",
								':did' => $_GET['did'],
								':phone' => $_SESSION['phone'],
							));
					
					$stmtws1 = $pdo->prepare("SELECT * FROM users where phone = :phone");
							$stmtws1->execute(array(":phone" => $_SESSION['phone'],));
							$row1 = $stmtws1->fetch(PDO::FETCH_ASSOC);					
					
					$precoinamount=$row1['coinamount'];
					$newcoinamount = $precoinamount + 10;
					
					$sqlws = "UPDATE users SET coinamount = :coinamount WHERE phone = :phone";
							$stmtws2 = $pdo->prepare($sqlws);
							$stmtws2->execute(array(
								':coinamount' => $newcoinamount,
								':phone' => $_SESSION['phone'],
							));
					unset($_POST['sharedwhatsapp']);
					header('Location: https://api.whatsapp.com/send?text=Check+out+this+deal+on+Ringgit+link+localhost%2Fproject%2Fdealdetails.php?did='.$dealid.'');
					return;
				} else{
					unset($_POST['sharedwhatsapp']);
					header('Location: https://api.whatsapp.com/send?text=Check+out+this+deal+on+Ringgit+link+localhost%2Fproject%2Fdealdetails.php?did='.$dealid.'');
					return;
				}
			}
		} 
		if(isset($_POST['sharedfacebook'])){
			if(!isset($_SESSION['phone'])){
				echo('hello');
				header('Location: dealdetails.php?did='.$dealid.'');
			} else{
				//to retrieve the share table to validify if user has shared or not
				$stmtsharefacebook = $pdo->prepare("SELECT * FROM share where did = :did and platform = 'facebook' and phone = :phone");
				$stmtsharefacebook->execute(array(":did" => $_GET['did'], ":phone" => $_SESSION['phone'],));
				$rows2 = $stmtsharefacebook->fetch(PDO::FETCH_ASSOC);
				
				$count2 = $stmtsharefacebook->rowCount(); 
				
				if($count2<1){
					$stmtfb = $pdo->prepare('INSERT INTO share (platform, did, phone) VALUES (:platform, :did ,:phone);');
				
							$stmtfb->execute(array(
								':platform' => "facebook",
								':did' => $_GET['did'],
								':phone' => $_SESSION['phone'],
							));
					
					$stmtfb1 = $pdo->prepare("SELECT * FROM users where phone = :phone");
							$stmtfb1->execute(array(":phone" => $_SESSION['phone'],));
							$row2 = $stmtfb1->fetch(PDO::FETCH_ASSOC);					
					
					$precoinamount=$row2['coinamount'];
					$newcoinamount = $precoinamount + 10;
					
					$sqlfb = "UPDATE users SET coinamount = :coinamount WHERE phone = :phone";
							$stmtfb2 = $pdo->prepare($sqlfb);
							$stmtfb2->execute(array(
								':coinamount' => $newcoinamount,
								':phone' => $_SESSION['phone'],
							));
					unset($_POST['sharedfacebook']);
					header('Location: http://www.facebook.com/share.php?u=https://ringgitwebappproject.000webhostapp.com/&quote=Check+out+this+deal+by+Ringgit');
					return;
				} else{
					unset($_POST['sharedfacebook']);
					header('Location: http://www.facebook.com/share.php?u=https://ringgitwebappproject.000webhostapp.com/&quote=Check+out+this+deal+by+Ringgit');
					return;
				}
			}
		} 
		if(isset($_POST['sharedtwitter'])){
			if(!isset($_SESSION['phone'])){
				echo('hello');
				header('Location: dealdetails.php?did='.$dealid.'');
			} else{
				//to retrieve the share table to validify if user has shared or not
				$stmtsharetwitter = $pdo->prepare("SELECT * FROM share where did = :did and platform = 'twitter' and phone = :phone");
				$stmtsharetwitter->execute(array(":did" => $_GET['did'], ":phone" => $_SESSION['phone'],));
				$rows3 = $stmtsharetwitter->fetch(PDO::FETCH_ASSOC);
				
				$count3 = $stmtsharetwitter->rowCount(); 
				
				if($count3<1){
					$stmttw = $pdo->prepare('INSERT INTO share (platform, did, phone) VALUES (:platform, :did ,:phone);');
				
							$stmttw->execute(array(
								':platform' => "twitter",
								':did' => $_GET['did'],
								':phone' => $_SESSION['phone'],
							));
					
					$stmttw1 = $pdo->prepare("SELECT * FROM users where phone = :phone");
							$stmttw1->execute(array(":phone" => $_SESSION['phone'],));
							$row3 = $stmttw1->fetch(PDO::FETCH_ASSOC);					
					
					$precoinamount=$row3['coinamount'];
					$newcoinamount = $precoinamount + 10;
					
					$sqltw = "UPDATE users SET coinamount = :coinamount WHERE phone = :phone";
							$stmttw2 = $pdo->prepare($sqltw);
							$stmttw2->execute(array(
								':coinamount' => $newcoinamount,
								':phone' => $_SESSION['phone'],
							));
					unset($_POST['sharedtwitter']);
					header('Location:https://twitter.com/intent/tweet?&text=Check+out+this+deal+on+Ringgit+link+localhost%2Fproject%2Fdealdetails.php?did='.$dealid.'');
					return;
				} else{
					unset($_POST['sharedtwitter']);
					header('Location: https://twitter.com/intent/tweet?&text=Check+out+this+deal+on+Ringgit+link+localhost%2Fproject%2Fdealdetails.php?did='.$dealid.'');
					return;
				}
			}
		} 
		if(isset($_POST['sharedemail'])){
			if(!isset($_SESSION['phone'])){
				echo('hello');
				header('Location: dealdetails.php?did='.$dealid.'');
			} else{
				//to retrieve the share table to validify if user has shared or not
				$stmtshareemail = $pdo->prepare("SELECT * FROM share where did = :did and platform = 'email' and phone = :phone");
				$stmtshareemail->execute(array(":did" => $_GET['did'], ":phone" => $_SESSION['phone'],));
				$rows4 = $stmtshareemail->fetch(PDO::FETCH_ASSOC);
				
				$count4 = $stmtshareemail->rowCount(); 
				
				if($count4<1){
					$stmtem = $pdo->prepare('INSERT INTO share (platform, did, phone) VALUES (:platform, :did ,:phone);');
				
							$stmtem->execute(array(
								':platform' => "email",
								':did' => $_GET['did'],
								':phone' => $_SESSION['phone'],
							));
					
					$stmtem1 = $pdo->prepare("SELECT * FROM users where phone = :phone");
							$stmtem1->execute(array(":phone" => $_SESSION['phone'],));
							$row4 = $stmtem1->fetch(PDO::FETCH_ASSOC);					
					
					$precoinamount=$row4['coinamount'];
					$newcoinamount = $precoinamount + 10;
					
					$sqlem = "UPDATE users SET coinamount = :coinamount WHERE phone = :phone";
							$stmtem2 = $pdo->prepare($sqlem);
							$stmtem2->execute(array(
								':coinamount' => $newcoinamount,
								':phone' => $_SESSION['phone'],
							));
					unset($_POST['sharedemail']);
					header('Location: https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=Check+this+deal+out&body=This+deal+is+suitable+for+you+link+localhost%2Fproject%2Fdealdetails.php?did='.$dealid.'&ui=2&tf=1&pli=1');
					return;
				} else{
					unset($_POST['sharedemail']);
					header('Location: https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=Check+this+deal+out&body=This+deal+is+suitable+for+you+link+localhost%2Fproject%2Fdealdetails.php?did='.$dealid.'&ui=2&tf=1&pli=1');
					return;
				}
			}
		} 
		
		
		
		
		$stmt = $pdo->prepare("SELECT * FROM deal where did = :did");
		$stmt->execute(array(":did" => $_GET['did']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$popularitycounter = $row['popularitycounter'];
			$sql = "UPDATE deal SET popularitycounter = :popularitycounter WHERE did = :did";
            $stmt2 = $pdo->prepare($sql);
            $stmt2->execute(array(
				':popularitycounter' => $popularitycounter+1,
				':did' => $dealid,
            ));
			
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
            <h1><a href="deal.php">Ringgit%</a> <a href="user.php"></h1>
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
				<?php
				// Program to display URL of current page.
				  
				if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
					$link = "https";
				else
					$link = "http";
				  
				// Here append the common URL characters.
				$link .= "://";
				  
				// Append the host(domain name, ip) to the URL.
				$link .= $_SERVER['HTTP_HOST'];
				  
				// Append the requested resource location to the URL
				$link .= $_SERVER['REQUEST_URI'];
					  
				$_SESSION['link'] = $link;
				echo('<p>'.$_SESSION['link'].'</p>');
				?>
				
				<form method="POST">
					<p class="share">Share:</p>
					<div class="icons">
					<button type="submit" name="sharedwhatsapp" class="btn btn-info">
					<i class="fab fa-whatsapp" style="font-size:50px;"></i>
					</button>
					<button type="submit" name="sharedfacebook" class="btn btn-info">
					<i class="fab fa-facebook" style="font-size:50px;"></i>
					</button>
					<button type="submit" name="sharedtwitter" class="btn btn-info">
					<i class="fab fa-twitter" style="font-size:50px;"></i>
					</button>
					<button type="submit" name="sharedemail" class="btn btn-info">
					<i class="fa fa-envelope" style="font-size:50px; aria-hidden="true" ></i>
					</button>
					</div>
					<p> </p>
				</form>
				
				<div class="terms">
					<p>*T&C applies</p>
				</div>
					
					
		
				<p> </p>
			</div>
	   </div>
	   
    </body>
</html>