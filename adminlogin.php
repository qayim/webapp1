<?php
	session_start();
    require_once "pdo.php";

//when user clicks cancel
 
     if (isset($_POST["cancel"])) {
        header('Location: index.php');
        return;
    }
	
    if (isset($_POST['aid']) && isset($_POST['apass'])) {
		
		if (strlen($_POST['aid']) < 1) {
            $_SESSION["error"] = "Email missing";
            header("Location: adminlogin.php");
            return;
        } else if (strlen($_POST['apass']) < 1) {
            $_SESSION["error"] = "Password missing";
            header("Location: adminlogin.php");
            return;
        } else {
            $stmt = $pdo->prepare('SELECT * FROM admin WHERE aid = :aid AND apass = :apass');
            $stmt->execute(array(
                ':aid' => htmlentities($_POST['aid']),
                ':apass' => htmlentities(md5($_POST['apass'])),
            ));
			 $count = $stmt->rowCount();  
			 
                if($count > 0){  
                     $_SESSION["aid"] = $_POST["aid"];  
					 $_SESSION["apass"] = md5($_POST["apass"]);
                     header("location: adminpage.php");  
                }  
                else{  
                      $_SESSION["error"] = "Wrong data"; 
					 header("location: adminlogin.php"); 
					 return;
                }  
            $_SESSION['success'] = "Logged in";
            header("Location: adminpage.php");
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
		.container-lg{
			text-align: center;
			margin: center;
		}
		
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
		#aid, #apass{
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
	 
        <?php 
		//error message
            if ( isset($_SESSION['error']) ) {
                echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                unset($_SESSION['error']);
              }
        ?>
		
		<div class="container-lg">
		<div class="logo">
		<h1>Ringgit%</h1>
		</div>
        <form method="POST">
            <input type="text" placeholder="admin id" name="aid" id="aid">
			<p> </p>
            <input type="password" placeholder="password" name="apass" id="apass">
			<p> </p>
            <input type="submit" class="btn btn-info btn-lg" value="Log In">
			
			<p> </p>
			<a href="index.php">Not an admin?</a>
			<p> </p>
		</div>
        </form>
	</div>
	<p> </p>
    </body>
</html>
