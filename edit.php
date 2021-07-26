<?php
require_once "pdo.php";
session_start();

	$dealid = $_SESSION['did'];

	// make sure id is there or not
	if ( ! isset($dealid) ) {
	  $_SESSION['error'] = "Missing did";
	  header('Location: edit.php');
	  return;
	}

	$stmt = $pdo->prepare("SELECT * FROM deal where did = :did");
	$stmt->execute(array(":did" => $dealid));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$dname= htmlentities($row['dname']);
	$dlogo = htmlentities($row['dlogo']);
	$dcompany = htmlentities($row['dcompany']);
	$dtagline = htmlentities($row['dtagline']);
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
	$did = $dealid;
	if ( $row === false ) {
		$_SESSION['error'] = 'Bad value for did';
		header( 'Location: index.php' ) ;
		return;
	}
    // check data legit or not
    if ( isset($_POST['dname']) && isset($_POST['dcompany']) && isset($_POST['daddress']) && isset($_POST['dpostal'])
		&& isset($_POST['dcountry']) && isset($_POST['dtagline']) && isset($_POST['ddesc']) && isset($_POST['damount']) && isset($_POST['dunit']) && isset($_POST['start'])
		&& isset($_POST['end']) && isset($_POST['dcountrysupp'])) {
        if (strlen($_POST['dname']) < 1) {
            $_SESSION['error'] = "Name missing";
            header("Location: edit.php");
            return;
        }  else if (strlen($_POST['dcompany']) < 1) {
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
			if($_FILES['dlogo']['size']==0){
				$picProfile=$dlogo;
			} else{
				$name=$_POST['dname'];

				$images=$_FILES['dlogo']['name'];
				$tmp_dir=$_FILES['dlogo']['tmp_name'];
				$imageSize=$_FILES['dlogo']['size'];

				$upload_dir='uploads/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$picProfile=rand(1000, 1000000).".".$imgExt;
				move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
			}
			

            $sql = "UPDATE deal SET dname = :dname, dlogo = :dlogo, dcompany = :dcompany, daddress = :daddress, dpostal = :dpostal, dcountry = :dcountry, dtagline = :dtagline, ddesc = :ddesc, damount = :damount, dunit = :dunit,  start = :start, end = :end, dcountrysupp = :dcountrysupp, dverify = :dverify WHERE did = :did";
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
				':end' => htmlentities($_POST['end']),
				':dverify' => "pending",
				':did' => $dealid,
            ));
        $_SESSION['error'] = 'Record edited';
        header( 'Location: edit.php' ) ;
        return;
        }
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
							<a href="deal.php">
							<h1>Ringgit%</h1>
							</a>
							<h2>Edit deal<h2>
							<?php
								  if ( isset($_SESSION['error']) ) {
									 echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
									 unset($_SESSION['error']);
								  }
							?>
				</div>

	<div class="container text-center">
        <form method="post" enctype="multipart/form-data">
        <p>Deal name:</p>
        <input type="text" name="dname" value="<?= $dname ?>">
		<p> </p>
        <p>Logo:</p>
		<?php
								echo('<img src="uploads/');
								echo($row['dlogo']);
								echo('" class="complogo" height="200px" width="200px">');
		?>
		<p> </p>
        <input type="file" name="dlogo" value="<?= $dlogo ?>">
		<p> </p>
        <p>Company:</p>
        <input type="text" name="dcompany" value="<?= $dcompany ?>">
		<p> </p>
		<p>Tagline:</p>
        <input type="text" name="dtagline" value="<?= $dtagline ?>">
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

						<p class="dlogo">Deal unit: </p>
							<input type="radio" id="rm" name="dunit" <?=$dunit=="RM" ? "checked" : ""?> value="RM" style="height:35px; width:35px; vertical-align: middle;">
							  <label for="rm">RM</label>
							  <input type="radio" id="giftcard" name="dunit" <?=$dunit=="Giftcard" ? "checked" : ""?> value="Giftcard" style="height:35px; width:35px; vertical-align: middle;">
							  <label for="giftcard">Giftcard</label>
							  <input type="radio" id="percentage" name="dunit" <?=$dunit=="%" ? "checked" : ""?> value="%" style="height:35px; width:35px; vertical-align: middle;">
							  <label for="percentage">% Percentage</label>

						<p> </p>
		<p>Period:</p>
		<p>Start:</p>
        <input type="date" name="start" value="<?= $start ?>">
		<p> to </p>
		<p>End:</p>
        <input type="date" name="end" value="<?= $end ?>">

		<p> </p>

						<p class="dlogo">Country supported:</p>
						<select name="dcountrysupp" id="dcountrysupp">
							<option value="Malaysia">Malaysia</option>
							<option value="Indonesia">Indonesia</option>
							<option value="Brunei">Brunei</option>
							<option value="Singapore">Singapore</option>
						  </select>

		<p> </p>

        <p><input type="submit" class="btn btn-info" value="Save" style="width: 53%"/>
					<button class="btn btn-danger" onclick="deleteConfirmationPopup()" type="button" style="width: 10%;"><i class="fas fa-trash"></i></button>
		<p> </p>
        <a href="deal.php" class="btn btn-danger">Cancel</a></p>
        </form>
	</div>
	</div>

	<script type="text/javascript">
	function deleteConfirmationPopup(){
		swal.fire({
			title: "Are you sure you want to delete this deal?",
			text: "This action cannot be undone.",
			icon: "warning",
			confirmButtonColor: '#ea5455',
			denyButtonColor: '#80CDF9',
			showDenyButton: true,
			confirmButtonText: "Delete",
			denyButtonText: "Cancel",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
						type: "POST",
						url: "dealdelete.php" ,
						data: { did: "<?php echo $dealid; ?>" },
						success : function() {
							swal.fire({
								title: "Deal Delete Successful!",
								icon: "success",
								showConfirmButton: false,
								allowOutsideClick: false,
								timer: 3000.
							}).then(() => {
								window.location.replace("deal.php");
							});
						},
						error : function(request, status, error) {
							swal.fire({
								title: "Delete failed!",
								text: "Error occured during the delete process",
								icon: "error",
								confirmButtonColor: '#ea5455',
							});
						}
				});
			}
		});
	}
	</script>
    </body>
</html>