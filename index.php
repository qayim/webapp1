<?php 
session_start();
    require_once "pdo.php";


    if (isset($_POST["cancel"])) {
        header('Location: index.php');
        return;
    }
	
    if (isset($_POST['email']) && isset($_POST['pass'])) {
		
		if (strlen($_POST['email']) < 1) {
            $_SESSION["error"] = "Email missing";
            header("Location: index.php");
            return;
        } else if (strlen($_POST['pass']) < 1) {
            $_SESSION["error"] = "Password missing";
            header("Location: index.php");
            return;
        } else {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :emai AND pass = :pas');
            $stmt->execute(array(
                ':emai' => htmlentities($_POST['email']),
                ':pas' => htmlentities(md5($_POST['pass'])),
            ));
			 $count = $stmt->rowCount();  
			 
                if($count > 0){  
                     $_SESSION["email"] = $_POST["email"];  
					 $_SESSION["pass"] = md5($_POST["pass"]);
                     header("location: deal.php");  
                }  
                else{  
                      $_SESSION["error"] = "Wrong data"; 
					 header("location: index.php"); 
					 return;
                }  
            $_SESSION['success'] = "Logged in";
            header("Location: deal.php");
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
		.logo{
			font-family: "Trebuchet MS", sans-serif;
			padding-top: 70px;
			padding-bottom: 30px;
		}
		#email, #pass{
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
	
		
     <div class="container fluid">   
	 
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
            <input type="email" placeholder="email" name="email" id="email">
			<p> </p>
            <input type="password" placeholder="password" name="pass" id="pass">
			<p> </p>
            <input type="submit" class="btn btn-info btn-lg" value="Log In">
			<p> </p>
		</form>
            <p>
            or
			</p>
			<a href=""><i class="fa fa-twitter" style="font-size:40px;"></i></a>
			<a href=""><i class="fa fa-facebook" style="font-size:40px;"></i></a>
			<a href=""><i class="fa fa-google" style="font-size:40px;"></i></a>
			<p> </p>
			<a href="">forgot your password?</a>
			<p> </p>
            <a href="signup.php" class="btn btn-info btn-lg">Sign up</a>
			<p> </p>
			<a href="adminlogin.php">Admins only</a>
			<p> </p>
			
		</div>
        
	</div>
    </body>
</html>