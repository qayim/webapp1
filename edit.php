<?php
require_once "pdo.php";
session_start();

 //for log in
 if (!isset($_SESSION["phone"])) {
    die("Not logged in");
}

if (isset($_POST["cancel"])) {
    header('Location: deal.php');
    return;
}

    // check data legit or not
    if ( isset($_POST['dname']) && isset($_POST['dlogo']) && isset($_POST['dcompany']) && isset($_POST['daddress']) && isset($_POST['dpostal']) 
		&& isset($_POST['dcountry']) && isset($_POST['dtagline']) && isset($_POST['ddesc']) && isset($_POST['damount']) && isset($_POST['dunit']) && isset($_POST['start'])
		&& isset($_POST['end']) && isset($_POST['dcountrysupp'])) {
        if (strlen($_POST['dname']) < 1) {
            $_SESSION['error'] = "Name missing";
            header("Location: edit.php");
            return;
        } else if (isset($_POST['dlogo'])) {
            $_SESSION['error'] = "Logo missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['dcompany']) < 1) {
            $_SESSION['error'] = "Company missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['daddress']) < 1) {
            $_SESSION['error'] = "Address missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['dpostal']) < 1) {
            $_SESSION['error'] = "Postal code missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['dcountry']) < 1) {
            $_SESSION['error'] = "Country missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['dtagline']) < 1) {
            $_SESSION['error'] = "Tag line missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['ddesc']) < 1) {
            $_SESSION['error'] = "Description missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['damount']) < 1) {
            $_SESSION['error'] = "Amount missing";
            header("Location: edit.php");
            return;
        } else if (!is_numeric($_POST['damount'])) {
            $_SESSION['error'] = "Amount must be numbers";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['dunit']) < 1) {
            $_SESSION['error'] = "Unit missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['start']) < 1) {
            $_SESSION['error'] = "Start date missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['end']) < 1) {
            $_SESSION['error'] = "End date missing";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['dcountrysupp']) <1) {
            $_SESSION['error'] = "Country support missing";
            header("Location: edit.php");
            return;
        } else {
			
			$name=$_POST['dname'];
				
				$images=$_FILES['dlogo']['name'];
				$tmp_dir=$_FILES['dlogo']['tmp_name'];
				$imageSize=$_FILES['dlogo']['size'];
				
				$upload_dir='uploads/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$picProfile=rand(1000, 1000000).".".$imgExt;
				move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
				
            $sql = "UPDATE deal SET dname = :dname, dlogo = :dlogo, dcompany = :dcompany, daddress = :daddress, dpostal = :dpostal, dcountry = :dcountry, dtagline = :dtagline, ddesc = :ddesc, damount = :damount, dunit = :dunit,  start = :start, end = :end, dcountrysupp = :dcountrysupp, WHERE did = :did";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
               ':dname' => htmlentities($_POST['dname']),
				':dlogo' => htmlentities($picProfile),
				':dcompany' => htmlentities($_POST['dcompany']),
				':daddress' => htmlentities($_POST['daddress']),
				':dpostal' => htmlentities($_POST['dpostal']),
				':dcountry' => htmlentities($_POST['dcountry']),
				':dtagline' => htmlentities($_POST['dtagline']),
				':ddesc' => htmlentities($_POST['ddesc']),
				':damount' => htmlentities($_POST['damount']),
				':dunit' => htmlentities($_POST['dunit']),
				':start' => htmlentities($_POST['start']),
				':end' => htmlentities($_POST['end']),
				':dcountrysupp' => htmlentities($_POST['dcountrysupp']),
            ));
        $_SESSION['success'] = 'Record edited';
        header( 'Location: edit.php' ) ;
        return;
        }
    }

// make sure id is there or not
if ( ! isset($_GET['phone']) ) {
  $_SESSION['error'] = "Missing did";
  header('Location: edit.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM deal where did = :did");
$stmt->execute(array(":did" => $_GET['did']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for did';
    header( 'Location: index.php' ) ;
    return;
}

// message if error
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$dname= htmlentities($row['dname']);
$dlogo = htmlentities($row['dlogo']);
$dcompany = htmlentities($row['dcompany']);
$daddress = htmlentities($row['daddress']);
$dpostal = htmlentities($row['dpostal']);
$dcountry = htmlentities($row['dcountry']);
$dtagline = htmlentities($row['dtagline']);
$ddesc = htmlentities($row['ddesc']);
$damount = htmlentities($row['damount']);
$dunit = htmlentities($row['dunit']);
$start = htmlentities($row['start']);
$end = htmlentities($row['end']);
$dcountrysupp = htmlentities($row['dcountrysupp']);
$did = $row['did'];
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
		
		</style>
    </head>
    <body>
    <div class="jumbotron text-center">
	<h1>Edit Deal</h1>
	</div>
	<div class="container text-center">
        <form method="post" enctype="multipart/form-data">
        <p>Deal name:</p>
        <input type="text" name="dname" value="<?= $dname ?>">
		<p> </p>
        <p>Logo:</p>
        <input type="file" name="dlogo" value="<?= $dlogo ?>">
		<p> </p>
        <p>Company:</p>
        <input type="text" name="dcompany" value="<?= $dcompany ?>">
		<p> </p>
		<p>Address:</p>
        <input type="text" name="daddress" value="<?= $daddress ?>">
		<p> </p>
		<p>Postal:</p>
        <input type="text" name="dpostal" value="<?= $dpostal ?>">
		<p> </p>
		<p>Country:</p>
        <input type="text" name="dcountry" value="<?= $dcountry ?>">
		<p> </p>
		<p>Description:</p>
        <input type="text" name="ddesc" value="<?= $ddesc ?>">
		<p> </p>
		<p>Amount:</p>
        <input type="text" name="damount" value="<?= $damount ?>">
		<p> </p>
		<p>Unit:</p>
        <input type="text" name="dunit" value="<?= $dunit ?>">
		<p> </p>
		<p>Period:</p>
		<p>Start:</p>
        <input type="date" name="start" value="<?= $start ?>">
		<p> to </p>
		<p>End:</p>
        <input type="date" name="end" value="<?= $end ?>">
		<p> </p>
		<p>Country supported:</p>
        <input type="text" name="countrysupp" value="<?= $countrysupp ?>">
		<p> </p>
		
        <p><input type="submit" class="btn btn-primary" value="Save"/>
        <a href="deal.php" class="btn btn-danger">Cancel</a></p>
        </form>
	</div>
    </body>
</html>