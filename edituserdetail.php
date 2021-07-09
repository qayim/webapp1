<?php
require_once "pdo.php";
session_start();

 //for log in
 if (!isset($_SESSION["phone"])) {
    die("Not logged in");
}

if (isset($_POST["cancel"])) {
    header('Location: duser.php');
    return;
}

$phone = $_SESSION["phone"];

    // check data legit or not
    if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['postal']) && isset($_POST['country']) && isset($_POST['gender'])) {
        if (strlen($_POST['name']) < 1) {
            $_SESSION['error'] = "Name missing";
            header("Location: edituserdetail.php");
            return;
        } else if (isset($_POST['email'])<1) {
            $_SESSION['error'] = "Email missing";
            header("Location: edituserdetail.php");
            return;
        } else if (strlen($_POST['address']) < 1) {
            $_SESSION['error'] = "Address missing";
            header("Location: edituserdetail.php");
            return;
        } else if (strlen($_POST['postal']) < 1) {
            $_SESSION['error'] = "Postal code missing";
            header("Location: edituserdetail.php");
            return;
        } else if (strlen($_POST['country']) < 1) {
            $_SESSION['error'] = "Country missing";
            header("Location: edituserdetail.php");
            return;
        } else if (strlen($_POST['gender']) < 1) {
            $_SESSION['error'] = "Tag line missing";
            header("Location: edituserdetail.php");
            return;
        } else {	
            $sql = "UPDATE users SET name = :name, email = :email, address = :address, postal = :postal, country = :country, gender = :gender WHERE phone = :phone";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':name' => htmlentities($_POST['name']),
				':email' => htmlentities($_POST['email']),
				':address' => htmlentities($_POST['address']),
				':postal' => htmlentities($_POST['postal']),
				':country' => htmlentities($_POST['country']),
				':gender' => htmlentities($_POST['gender']),
				':phone' => $phone,
				
            ));
        $_SESSION['success'] = 'Record edited';
        header( 'Location: edituserdetail.php' ) ;
        return;
        }
    }

// make sure id is there or not
if ( ! isset($phone) ) {
  $_SESSION['error'] = "Missing phone";
  header('Location: edituserdetail.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM users where phone = :phone");
$stmt->execute(array(":phone" => $phone));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for phone';
    header( 'Location: index.php' ) ;
    return;
}

// message if error
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$name= htmlentities($row['name']);
$email = htmlentities($row['email']);
$address = htmlentities($row['address']);
$postal = htmlentities($row['postal']);
$country = htmlentities($row['country']);
$gender = htmlentities($row['gender']);
$phone = $row['phone'];
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
		.container-sm{
			text-align: center;
			padding: 10px;
			width:600px;
		}
		.logo{
			font-family: "Trebuchet MS", sans-serif;
			padding-top: 70px;
			padding-bottom: 30px;
		}
		input{
			padding:10px;
			height:53px;
			width:355px;
			font-size:23px;
		}
		.btn{
			height:53px;
			width:355px;
		}
		#name, #email, #address, #postal, #country{
			padding:10px;
			height:53px;
			width:355px;
			font-size:14pt;
		}
		</style>
    </head>
    <body>
	<div class="container-sm p-1 border">
				<div class="logo">
							<a href="deal.php">
							<h1>Ringgit%</h1>
							</a>
							<h2>Edit user<h2>
							<?php 
								  if ( isset($_SESSION['error']) ) {
									 echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
									 unset($_SESSION['error']);
								  }
							?>
				</div>
			
			<div class="container text-center">
				<form method="post" enctype="multipart/form-data">
				<p>Name:</p>
				<input type="text" name="name" value="<?= $name ?>">
				<p> </p>
				<p>Email:</p>
				<input type="text" name="email" value="<?= $email ?>">
				<p> </p>
				<p>Address:</p>
				<input type="text" name="address" value="<?= $address ?>">
				<p> </p>
				<p>Postal:</p>
				<input type="text" name="postal" value="<?= $postal ?>">
				<p> </p>
				<p>Country:</p>
				<input type="text" name="country" value="<?= $country ?>">
				<p> </p>
			</div>
	
				<p>Gender: </p>
							  <input type="radio" id="male" name="gender" <?=$gender=="male" ? "checked" : ""?> value="male" style="height:35px; width:35px; vertical-align: middle;">
							  <label for="male">Male</label>
							  <input type="radio" id="female" name="gender" <?=$gender=="female" ? "checked" : ""?> value="female" style="height:35px; width:35px; vertical-align: middle;">
							  <label for="female">Female</label>
							  <input type="radio" id="other" name="gender" <?=$gender=="other" ? "checked" : ""?> value="other" style="height:35px; width:35px; vertical-align: middle;">
							  <label for="other">Other</label>
				<p> </p>
		
				<p><input type="submit" class="btn btn-info" value="Save"/>
				<p> </p>
				<a href="user.php" class="btn btn-danger">Cancel</a></p>
				</form>
	</div>		
	
    </body>
</html>