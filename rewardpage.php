<?php
	session_start();
	require_once "pdo.php";

	if ( ! isset($_SESSION['phone']) ) {
		$_SESSION['error'] = "Missing phone number";
		header('Location: deal.php');
		return;
	}

	$stmt = $pdo->query("SELECT * FROM reward;");
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

		<style>

    /* DEBUGGING
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

		.row{
			font-size: 20px;
		}

		.dcode{
			font-weight: bold;
			font-size: 30px;
		}

    /* -- Reward Blocks -- */

    .rewardicon{
      display: inline-flex;
      width: 100px;
      height: 100px;
      justify-content: center;
    }

    .rewardicon img{
      max-width: 100%;
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
      cursor: pointer;
    }

		.reward a{
			color: black;
			display: block;
		  width: 100%;
		  height: 100%;
		}

		.reward a:hover{
			color: black;
			text-decoration: none;
		}

    .reward h4{
      margin-bottom: 15px;
    }

    .terms{
			padding-top: 5px;
		}

    .terms p{
      font-size: 13px;
			text-align: center;
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
        <h1 style="color: #80CDF9;">Rewards to claim</h1>
        <h2>Claim rewards here!</h2>
      </div>

      <div class="d-flex flex-row justify-content-around flex-wrap" style="margin-top: 20px;">
        <?php
				foreach($rows as $row) {
					echo '<div id="reward" class="reward col-sm-3"><a href="rewardredemption.php?rid=' . $row['rid'] . '">';
          echo '<h4>'. $row['type'] .'</h4>';
          echo '<h4>'. $row['rname'] .'</h4>';
					echo '<p>' . $row['rdesc'] . '</p>';
          echo '<p style="font-size: 18px; font-weight: bold;">' . $row['coinprice'] . ' Coins</p>';
          echo '<hr>';
          echo '
          <div class="container">
            <div class="terms">
              <p>*T&C applies</p>
            </div>
          </div>
          ';
          echo '</a></div>';
				}
        ?>
      </div>

      <script lang="javascript">
      </script>

    </body>
</html>