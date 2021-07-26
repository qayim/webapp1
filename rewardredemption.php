<?php
	session_start();
  require_once "pdo.php";

	if ( ! isset($_SESSION['phone']) ) {
		$_SESSION['error'] = "Missing phone number";
		header('Location: deal.php');
		return;
	}

	if ( !isset($_GET['rid']) ) {
		header('Location: rewardpage.php');
		return;
	}
	else {
		$rid = $_GET['rid'];
		$stmt = $pdo->prepare("SELECT * FROM reward where rid = :rid;");
		$stmt->execute(array(":rid" => $rid));
		$reward = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	if (!$reward) {
		header('Location: rewardpage.php');
		return;
	}

	$phone = $_SESSION['phone'];
	$stmt = $pdo->prepare("SELECT * FROM users where phone = :phone");
	$stmt->execute(array(":phone" => $phone));
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Muhammad Qayim bin Norizan</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

		<style>

		/* DEBUGGIN CSS
    * {
      background: #000 !important;
      color: #0f0 !important;
      outline: solid #f00 1px !important;
    }
		*/

    /* -- Header -- */

		body {
			background-color: #f9f9f9;
		}

    .header {
      background-color: #ffffff;
			box-shadow: 0 0 2px grey;
    }

		.logo{
			font-family: "Trebuchet MS", sans-serif;
			padding-left: 25px;
      padding-right: 35px;
		}

    .logo a{
      color: black;
    }

    .logo a:hover{
      text-shadow: 0 0 1px black;
      text-decoration: none;
    }

    /* -- Content -- */

    .content{
      width: 100%;
    }

    /* -- Reward Blocks -- */

    .rewardicon img{
      max-width: 200px;
      height: auto;
    }

    .reward{
      background-color: rgba(178, 223, 251, 0.7);
      padding: 5px;
      margin: 5px;
      text-align: center;
    }

    .reward:hover {
      background-color: rgba(178, 223, 251, 1);
      box-shadow: 0 0 6px #888888;
    }

    .reward h4{
      margin-bottom: 15px;
    }

    .reward .coins{
      font-size: 18px;
      font-weight: bold;
    }

		.swal-overlay {
		  background-color: rgba(0, 0, 0, 0.2);
		}

		/* --Sweet Alert-- */

		body.swal2-shown > [aria-hidden="true"] {
		  filter: blur(2px);
		}

		body > * {
		  transition: 0.1s filter linear;
		}

		.sweet_loader {
			width: 140px;
			height: 140px;
			margin: 0 auto;
			animation-duration: 0.5s;
			animation-timing-function: linear;
			animation-iteration-count: infinite;
			animation-name: ro;
			transform-origin: 50% 50%;
			transform: rotate(0) translate(0,0);
		}

		@keyframes ro {
			100% {
				transform: rotate(-360deg) translate(0,0);
			}
		}

		</style>
    </head>
    <body>

      <div class="header">
        <table style="height: 100px;">
          <tbody>
            <tr>
              <td class="align-middle">
                <div class="logo">
          				<a href="deal.php"><h1>Ringgit%</h1></a>
          		  </div>
              </td>
              <td class="align-middle">
                <h2 style="background-color: #f9f9f9; padding: 8px; border-radius: 10px;">
                  <i class="fas fa-coins"></i> Coins:
           				<?php
           						echo(" ".$user['coinamount']." ");
           				?>
           		  </h2>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="padding-left: 25px; padding-top: 15px;">
        <h1 style="color: #80CDF9; padding-left: 100px;"><?php echo $reward['rname']; ?></h1>
      </div>

      <div class="container" style="text-align: center;">
        <div class="d-flex flex-column justify-content-center">
          <div class="rewardicon">
            
          </div>
          <div>
            <h1 style="padding-bottom: 20px;"><?php echo $reward['type']; ?></h1>
            <p><?php echo $reward['rdesc']; ?></p>
            <h6>Reward price: <?php echo $reward['coinprice']; ?> Coins</h6>
          </div>
          <div class="confirmationForm">
						<button onclick="confirmationPopup()" type="button" style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px; margin-top: 20px; background-color: #80CDF9;">Claim reward</button>
          </div>
        </div>
      </div>
			<script type="text/javascript">
			var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';

			function confirmationPopup(){
				swal.fire({
					title: "Are you sure you want to redeem?",
					text: "This action cannot be undone.",
					confirmButtonColor: '#80CDF9',
					showDenyButton: true,
					confirmButtonText: "Claim",
					denyButtonText: "Cancel",
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
								type: "POST",
								url: "rewardredeem.php" ,
								data: { rid: "<?php echo $_GET['rid']; ?>" },
								beforeSend : function() {
									swal.fire({
					            html: '<h2>Loading...</h2>',
					            showConfirmButton: false,
											allowOutsideClick: false,
					        });
									$('.swal2-html-container').prepend(sweet_loader);
								},
								success : function() {
									swal.fire({
										title: "Redeem Successful!",
										text: "Please check your e-mail for your reward",
										icon: "success",
										confirmButtonColor: '#80CDF9',
									}).then(() => {
										location.reload();
									});
								},
								error : function(request, status, error) {
									if (request.status == 404) { // 404 NOT FOUND ERROR
										swal.fire({
											title: "404 Error Occured",
											text: "Please contact our support team.",
											icon: "error",
											confirmButtonColor: '#ea5455',
										});
									}
									else if (request.status == 500) { // 500 INTERNAL SERVER ERROR
										swal.fire({
											title: "500 Error Occured",
											text: "Please contact our support team.",
											icon: "error",
											confirmButtonColor: '#ea5455',
										});
									}
									else { // No HTTP Requests Error
										var errorJSON = jQuery.parseJSON(request.responseText);
										var errorCode = errorJSON.code;
									}
									if (errorCode == 9999) { // CUSTOM 9999 ERROR
										swal.fire({
											title: "Oops. It seems like you don't have enough coins.",
											icon: "error",
											confirmButtonColor: '#ea5455',
											footer: '<a href="deal.php" style="font-weight: bold; color: #2196f3;">Click here to get more!</a>'
										});
									}
									else if (errorCode == 9998) { // CUSTOM 9998 ERROR
										swal.fire({
											title: "The reward you chose does not exist!",
											text: "Please refresh the reward page.",
											icon: "error",
											confirmButtonColor: '#ea5455',
										}).then(() => {
											window.location.href = "rewardpage.php";
										});
									}
								}
						});
					}
				});
			}
			</script>
    </body>
</html>