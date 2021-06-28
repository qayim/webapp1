<?php
    session_start();
    require_once "pdo.php";
	
	if (isset($_POST['insert'])) {
		
		if (strlen($_POST['dname']) < 1) {
            $_SESSION['error'] = "Name missing";
            header("Location: dealregister.php");
            return;
        } else if (isset($_POST['dlogo'])) {
            $_SESSION['error'] = "Logo missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['dcompany']) < 1) {
            $_SESSION['error'] = "Company missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['daddress']) < 1) {
            $_SESSION['error'] = "Address missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['dpostal']) < 1) {
            $_SESSION['error'] = "Postal code missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['dcountry']) < 1) {
            $_SESSION['error'] = "Country missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['dtagline']) < 1) {
            $_SESSION['error'] = "Tag line missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['ddesc']) < 1) {
            $_SESSION['error'] = "Description missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['damount']) < 1) {
            $_SESSION['error'] = "Amount missing";
            header("Location: dealregister.php");
            return;
        } else if (!is_numeric($_POST['damount'])) {
            $_SESSION['error'] = "Amount must be numbers";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['dunit']) < 1) {
            $_SESSION['error'] = "Unit missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['start']) < 1) {
            $_SESSION['error'] = "Start date missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['end']) < 1) {
            $_SESSION['error'] = "End date missing";
            header("Location: dealregister.php");
            return;
        } else if (strlen($_POST['dcountrysupp']) <1) {
            $_SESSION['error'] = "Country support missing";
            header("Location: dealregister.php");
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
				$pcode=rand(1,10)*12*rand(1,123).chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90));
				move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
			
            $stmt = $pdo->prepare('INSERT INTO deal (dcode, dname, dlogo, dcompany, daddress, dpostal, dcountry, dtagline, ddesc, damount, dunit, start, end, dcountrysupp) VALUES (:dcode, :dname, :dlogo, :dcompany, :daddress, :dpostal, :dcountry, :dtagline, :ddesc, :damount, :dunit, :start, :end, :dcountrysupp)');
			
			$stmt->execute(array(
				':dcode' => htmlentities($pcode),
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
            $_SESSION['success'] = "Record added";
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
        <p> </p>
		<div class="container-sm p-1 border">
			<div class="logo">
				<h1>Ringgit%</h1>
				<h2>Register deal<h2>
				<?php 
					  if ( isset($_SESSION['error']) ) {
						 echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
						 unset($_SESSION['error']);
					  }
				?>
			</div>        
                    <form method="POST" enctype="multipart/form-data">
                        <input type="text" placeholder="Deal name" name="dname" id="dname">
						<p> </p>
						
						<div class="container-fixed">
						<p class="dlogo">Company logo </p>
							<input type="file" name="dlogo" id="dlogo" accept="*/image" /> 
						</div>
						
						<p> </p>
						
                        <input type="text" placeholder="Company name" name="dcompany" id="dcompany"></br>
						
						<p> </p>
						
						<input type="text" placeholder="Address" name="daddress" id="daddress">
						
						<p> </p>
						
                        <input type="text" placeholder="Postal" name="dpostal" id="dpostal">
						
						<p> </p>
						<p class="dlogo">Company country:</p>
						<select name="dcountry" id="dcountry">
							<option value="Malaysia">Malaysia</option>
							<option value="Indonesia">Indonesia</option>
							<option value="Brunei">Brunei</option>
							<option value="Singapore">Singapore</option>
						 </select>
						
						<p> </p>
						
						<input type="text" placeholder="Tag line" name="dtagline" id="dtagline">
						
						<p> </p>
						
						<input type="textarea" placeholder="Description" name="ddesc" id="ddesc">
						
						<p> </p>
						
						<input type="text" placeholder="Amount" name="damount" id="damount">
						
						<p> </p>
						
						<p class="dlogo">Deal unit: </p>
							  <input type="radio" id="giftcard" name="dunit" value="giftcard" style="height:35px; width:35px; vertical-align: middle;">
							  <label for="giftcard">Giftcard</label>
							  <input type="radio" id="percentage" name="dunit" value="%" style="height:35px; width:35px; vertical-align: middle;>
							  <label for="percentage">% Percentage</label>
							  
						<p> </p>
						
						<p class="dlogo">Period </p>
						<input type="date" name="start" id="start">
						<p class="to">to</p>
						<input type="date" name="end" id="end">
						
						<p> </p>
						
						<p class="dlogo">Country supported:</p>
						<select name="dcountrysupp" id="dcountrysupp">
							<option value="Malaysia">Malaysia</option>
							<option value="Indonesia">Indonesia</option>
							<option value="Brunei">Brunei</option>
							<option value="Singapore">Singapore</option>
						  </select>
  
						<p> </p>

                        <input type="submit" name="insert"  class="btn btn-info btn-lg" value="Register">
						
						<p> </p>
						
                    </form>
        </div>
		<p> </p>
    </body>
</html>

<script>  
 $(document).ready(function(){  
      $('#Register').click(function(){  
           var image_name = $('#dlogo').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#dlogo').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#dlogo').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  
