<?php
    session_start();
    require_once "pdo.php";


    if (isset($_POST["cancel"])) {
        header('Location: index.php');
        return;
    }
	
		
	
    if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['postal']) && isset($_POST['country']) && isset($_POST['gender'])) {
					
		$refuser = 'F';
		$reftype = 'first'; 
		$coin = 0;
					
		if (strlen($_POST['email']) < 1) {
            $_SESSION['error'] = "Email missing";
            header("Location: signup.php");
            return;
        } else if (strlen($_POST['pass']) < 1) {
            $_SESSION['error'] = "Password missing";
            header("Location: signup.php");
            return;
        } else if (strlen($_POST['name']) < 1) {
            $_SESSION['error'] = "Name missing";
            header("Location: signup.php");
            return;
        } else if (strlen($_POST['phone']) < 1) {
            $_SESSION['error'] = "Phone number missing";
            header("Location: signup.php");
            return;
        } else if (strlen($_POST['address']) < 1) {
            $_SESSION['error'] = "Address missing";
            header("Location: signup.php");
            return;
        } else if (strlen($_POST['postal']) < 1) {
            $_SESSION['error'] = "Postal code missing";
            header("Location: signup.php");
            return;
        } else if (strlen($_POST['country']) < 1) {
            $_SESSION['error'] = "Country missing";
            header("Location: signup.php");
            return;
        } else if (strlen($_POST['gender']) < 1) {
            $_SESSION['error'] = "Gender missing";
            header("Location: signup.php");
            return;
        } else if (!is_numeric($_POST['phone'])) {
            $_SESSION['error'] = "Phone must be numbers";
            header("Location: signup.php");
            return;
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (email, pass, name, phone, address, postal, country, gender, stats, referalcode, refertype, coinamount) VALUES (:emai, :pas, :nam, :phon, :addres, :posta, :countr, :gende, :stats, :referalcode, :refertype, :coinamount)');
            $stmt->execute(array(
                ':emai' => htmlentities($_POST['email']),
                ':pas' => htmlentities(md5($_POST['pass'])),
                ':nam' => htmlentities($_POST['name']),
				':phon' => htmlentities($_POST['phone']),
                ':addres' => htmlentities($_POST['address']),
                ':posta' => htmlentities($_POST['postal']),
				':countr' => htmlentities($_POST['country']),
                ':gende' => htmlentities($_POST['gender']),
				':stats' => 'active',
				':referalcode' =>  $refuser.rand(1000,9999)*rand(1,10)*rand(1,10),
				':refertype' => $reftype,
				':coinamount' => $coin,
            ));
			
            $_SESSION['success'] = "Record added";
            header("Location: index.php");
            return;
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
		.container{
			text-align: center;
		}
		.logo{
			font-family: "Trebuchet MS", sans-serif;
			padding-top: 70px;
			padding-bottom: 30px;
		}
		#email, #pass, #name, #phone, #address, #postal, #country, #gender{
			padding:10px;
			height:53px;
			width:355px;
			font-size:14pt;
		}
		.btn{
			height:53px;
			width:355px;
		}
		
		</style>
    </head>
    <body>
		<div class="container fluid">
		<div class="logo">
		<h1>Ringgit%</h1>
		</div>
		<?php 
              if ( isset($_SESSION['error']) ) {
                 echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                 unset($_SESSION['error']);
              }
        ?>
           <div class="container">         
                    
                    <form method="POST">
                        <input type="email" placeholder="email" name="email" id="email">
						<p> </p>
                        <input type="password" placeholder="password" name="pass" id="pass">
						<p> </p>
                        <input type="text" placeholder="name" name="name" id="name"></br>
						<p> </p>
						<input type="text" placeholder="phone number" name="phone" id="phone">
						<p> </p>
                        <input type="text" placeholder="address" name="address" id="address">
						<p> </p>
                        <input type="text" placeholder="postal" name="postal" id="postal"></br>
						<p> </p>
						<input type="text" placeholder="country" name="country" id="country">
						<p> </p>
						</div>
						
						<p>Gender: </p>
							  <input type="radio" id="male" name="gender" value="male">
							  <label for="male">Male</label>
							  <input type="radio" id="female" name="gender" value="female">
							  <label for="female">Female</label>
							  <input type="radio" id="other" name="gender" value="other">
							  <label for="other">Other</label>
						<p> </p>
						
                        <input type="submit" class="btn btn-info btn-lg" value="Sign Up">
						<p> </p>
                    </form>
        </div>
    </body>
</html>