<?php
require_once "pdo.php";
session_start();
if ( ! isset($_SESSION['aid']) ) {
		  $_SESSION['error'] = "Missing admin id";
		  session_destroy();
		  header('Location: index.php');
		  return;
	}
    // check data legit or not
    if ( isset($_POST['rname']) && isset($_POST['type']) && isset($_POST['coinprice']) && isset($_POST['status'])
		&& isset($_POST['rdesc']) && isset($_POST['rcode'])) {
        if (strlen($_POST['rname']) < 1) {
            $_SESSION['error'] = "Name missing";
			header( 'Location: admincreatereward.php') ;
            return;
        }  else if (strlen($_POST['type']) < 1) {
            $_SESSION['error'] = "Type missing";
			header( 'Location: admincreatereward.php') ;
            return;
        } else if (strlen($_POST['coinprice']) < 1) {
            $_SESSION['error'] = "Coin price missing";
			header( 'Location: admincreatereward.php') ;
            return;
        } else if (!is_numeric($_POST['coinprice'])) {
            $_SESSION['error'] = "Coin price must be numbers";
			header( 'Location: admincreatereward.php') ;
            return;
        } else if (strlen($_POST['status']) < 1) {
            $_SESSION['error'] = "Status missing";
			header( 'Location: admincreatereward.php') ;
            return;
        } else if (strlen($_POST['rdesc']) < 1) {
            $_SESSION['error'] = "Description missing";
			header( 'Location: admincreatereward.php') ;
            return;
        } else if (strlen($_POST['rcode']) < 1) {
            $_SESSION['error'] = "Code missing";
			header( 'Location: admincreatereward.php') ;
            return;
        } else {
            $sql1 = "INSERT INTO reward (rname, type, coinprice, status, rdesc, rcode) values (:rname, :type, :coinprice, :status, :rdesc, :rcode)";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute(array(
                ':rname' => htmlentities($_POST['rname']),
				':type' => htmlentities($_POST['type']),
				':coinprice' => htmlentities($_POST['coinprice']),
				':status' => htmlentities($_POST['status']),
				':rdesc' => htmlentities($_POST['rdesc']),
				':rcode' => htmlentities($_POST['rcode']),
            ));
        $_SESSION['error'] = 'Record added';
			header( 'Location: admincreatereward.php') ;
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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
		.dlogo{
			font-size: 23px;
		}
		.to{
			font-size: 20px;
			padding: 10px;
		}
		#dcountry, #dcountrysupp{
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
							<a href="adminpage.php">
							<h1>Ringgit%</h1>
							</a>
							<h2>Create reward<h2>
							<?php
								  if ( isset($_SESSION['error']) ) {
									 echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
									 unset($_SESSION['error']);
								  }
							?>
				</div>

	<div class="container text-center">
        <form method="post" enctype="multipart/form-data">
        <p>Reward name:</p>
        <input type="text" name="rname">
		<p> </p>
        <p class="activate">Type: </p>
			<input type="radio" id="Voucher" name="type" value="Voucher" style="height:35px; width:35px; vertical-align: middle;">
				<label for="Voucher">Voucher</label>
			<input type="radio" id="Cash" name="type" value="Cash" style="height:35px; width:35px; vertical-align: middle;">
				<label for="Cash">Cash</label>	
			<input type="radio" id="Discount" name="type" value="Discount" style="height:35px; width:35px; vertical-align: middle;">
				<label for="Discount">Discount</label>	
		<p> </p>
		<p>Coin price:</p>
        <input type="text" name="coinprice">
		<p> </p>
		<p class="activate">Status: </p>
			<input type="radio" id="active" name="status" value="active" style="height:35px; width:35px; vertical-align: middle;">
				<label for="active">Activate</label>
				<input type="radio" id="deactive" name="status" value="deactive" style="height:35px; width:35px; vertical-align: middle;">
				<label for="deactive">Deactivate</label>	
			<p> </p>
		<p>Description:</p>
        <input type="text" name="rdesc">
		<p> </p>
		<p>Code:</p>
        <input type="text" name="rcode">
		<p> </p>

        <p><input type="submit" class="btn btn-info" value="Save" style="width: 53%"/>
		<p> </p>
        <a href="adminreward.php" class="btn btn-danger">Cancel</a></p>
        </form>
	</div>
	</div>

	
    </body>
</html>