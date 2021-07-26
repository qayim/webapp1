<?php 
session_start();
    require_once "pdo.php";
	
	$phone = $_SESSION['phone'];
	
    if (isset($_POST["cancel"])) {
        header('Location: user.php');
        return;
    }
	
    if (isset($_POST['referalcode'])) {
		
		 $stmt1 = $pdo->prepare('SELECT * FROM referal WHERE referalcode= :referalcode');
            $stmt1->execute(array(
                ':referalcode' => htmlentities($_POST['referalcode']),
            ));
			
			$rows2 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			
			$count1 = $stmt1->rowCount();  
		
		$stmt2 = $pdo->prepare('SELECT * FROM users WHERE phone= :phone'); //own user
            $stmt2->execute(array(
                ':phone' => $phone,
            ));
		$rows3 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($rows3 as $row3){
		
			if (strlen($_POST['referalcode']) < 1) {
				$_SESSION["error"] = "Referal code missing";
				header("Location: referalcoderedemption.php");
				return;
			} elseif ($count1>0){
				$_SESSION["error"] = "Referal code already claimed";
				header("Location: referalcoderedemption.php");
				return;
			} elseif($_POST['referalcode'] === $row3['referalcode']){
				$_SESSION["error"] = "Own referal code cannot be claimed";
				header("Location: referalcoderedemption.php");
				return;
			}else {
				$stmt = $pdo->prepare('SELECT * FROM users WHERE referalcode= :referalcode'); //the owner of the referal code user
				$stmt->execute(array(
					':referalcode' => htmlentities($_POST['referalcode']),
				));
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
				$count = $stmt->rowCount();  
				
				foreach($rows as $row){
						
						$refertypeacc = $row3['refertype'];
						$coinreward = 0;
						$coinmultiplier = 1;
						
						if($row['refertype']== "first"){
							$refertypeacc = "second";
							$coinreward = 50;
						} elseif($row['refertype']== "second"){
							$refertypeacc = "third";
							$coinreward = 20;
						} elseif ($row['refertype']== "third"){
							$refertypeacc = "third";
							$coinreward = 10;
						} else{
							$refertypeacc = "first";
						}
						
						if($row['category']== "king"){
							$coinmultiplier = 1.5;
						} elseif($row['category']== "duke"){
							$coinmultiplier = 1.2;
						} elseif ($row['category']== "peasant"){
							$coinmultiplier = 1;
						} else{
							$coinmultiplier = 1;
						}
						
						
						 $phonereferer = $row['phone'];
						 //adding coins award to the referal code owner
						 $precoinamount = ($row['coinamount'] + $coinreward) * $coinmultiplier;
						 //print($precoinamount);
						 $referalcounter = $row['referalcounter'] + 1;
						 $channel = "website";
						 $sql = "UPDATE users SET coinamount = :coinamount, referalcounter = :referalcounter WHERE phone = :phone";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(array(
								':coinamount' => $precoinamount,
								':referalcounter' => $referalcounter,
								':phone' => $phonereferer,
							));
						
						//adding coinsaward to the account owner
						$oricoinamount = $row3['coinamount'] + 25;
						$phonereferee = $_SESSION['phone'];
						
						
						$sql3 = "UPDATE users SET coinamount = :coinamount, refertype = :refertype WHERE phone = :phone;";
							$stmt3 = $pdo->prepare($sql3);
							$stmt3->execute(array(
								':coinamount' => $oricoinamount,
								':refertype' => $refertypeacc,
								':phone' => $phonereferee,
							));
							
							$stmt4 = $pdo->prepare('INSERT INTO referal (channel, ipadd, phone, referalcode) VALUES (:channel, :ipadd ,:phone, :referalcode);');
				
							$stmt4->execute(array(
								':channel' => $channel,
								':ipadd' => $_SERVER['REMOTE_ADDR'],
								':phone' => $phone,
								':referalcode' => htmlentities($_POST['referalcode']),
							));
				
					if($count > 0){  
						 $_SESSION['referalcode'] = $_POST['referalcode']; 
						 header("location: user.php");  
					}  
					else{  
						 $_SESSION['error'] = "Wrong data"; 
						 header("location: referalcoderedemption.php"); 
						 return;
					}  
				
				 
				
				$_SESSION['success'] = "Code claimed";
				header("Location: referalcoderedemption.php");
				return;
				}
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		.container-sm{
			text-align: center;
			padding: 10px;
			width:550px;
		}
		.logo{
			font-family: "Trebuchet MS", sans-serif;
			padding-top: 70px;
			padding-bottom: 30px;
		}
		#referalcode{
			padding:10px;
			height:53px;
			width:355px;
			font-size:14pt;
		}
		.btn{
			height:53px;
			width:355px;
		}
		.fa{
			padding: 10px;
		}
		</style>
    </head>
    <body>
	
		
     
	 
        
		<p> </p>
		<div class="container-sm p-1 border">
		<div class="logo">
		<a href="deal.php">
				<h1>Ringgit%</h1>
		</a>
			<?php 
              if ( isset($_SESSION['success']) ) {
                 echo('<p style="color: red;">'.htmlentities($_SESSION['success'])."</p>\n");
                 unset($_SESSION['success']);
              }
			?>
			<?php 
			//error message
				if ( isset($_SESSION['error']) ) {
					echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
					unset($_SESSION['error']);
				  }
			?>
				
		</div>
        <form method="POST">
            <input type="text" placeholder="Referal code" name="referalcode" id="referalcode">
			<p> </p>
            <input type="submit" class="btn btn-info btn-lg" value="Claim">
			<p> </p>
		</form>
		</div>
        
	
	<p> </p>
    </body>
</html>