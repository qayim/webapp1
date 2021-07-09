<?php 
session_start();
    require_once "pdo.php";


    if (isset($_POST["cancel"])) {
        header('Location: user.php');
        return;
    }
	
    if (isset($_POST['referalcode'])) {
		
		if (strlen($_POST['referalcode']) < 1) {
            $_SESSION["error"] = "Referal code missing";
            header("Location: referalcoderedemption.php");
            return;
        } else {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE referalcode= :referalcode ');
            $stmt->execute(array(
                ':referalcode' => htmlentities($_POST['referalcode']),
            ));
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
			$count = $stmt->rowCount();  
			foreach($rows as $row){
			
					 $phone = $row['phone'];
					 print($phone);
					 $precoinamount = $row['coinamount'] + 50;
					 print($precoinamount);
					 $referalcounter = $row['referalcounter'] + 1;
					 $channel = "website";
					 $sql = "UPDATE users SET coinamount = :coinamount, referalcounter = :referalcounter WHERE phone = :phone";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array(
							':coinamount' => $precoinamount,
							':referalcounter' => $referalcounter,
							':phone' => $phone,
						));
						
						 $stmt = $pdo->prepare('INSERT INTO referral (channel, ipadd, phone) VALUES (:channel, :ipadd ,:phone)');
			
						$stmt->execute(array(
							':channel' => $channel,
							':ipadd' => $_SERVER['REMOTE_ADDR'],
							':phone' => $phone,
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
            header("Location: user.php");
            return;
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
	
		
     
	 
        <?php 
		//error message
            if ( isset($_SESSION['error']) ) {
                echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                unset($_SESSION['error']);
              }
        ?>
		<p> </p>
		<div class="container-sm p-1 border">
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