<?php
	session_start();
	require_once "pdo.php";

  sleep(1);

	if ( ! isset($_SESSION['phone']) ) {
		$_SESSION['error'] = "Missing phone number";
		header('Location: deal.php');
		return;
	}

  if ( ! isset($_POST['rid']) ) {
		header('Location: deal.php');
		return;
	}

  $phone = $_SESSION['phone'];

  $rid = $_POST['rid'];
	$stmt = $pdo->prepare("SELECT * FROM reward where rid = :rid");
  $stmt->execute(array(":rid" => $rid));
	$reward = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$phone = $_SESSION['phone'];
	$stmt = $pdo->prepare("SELECT * FROM users where phone = :phone");
	$stmt->execute(array(":phone" => $phone));
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($reward) {
    if ($user['coinamount'] >= $reward[0]['coinprice']) {
      $balance = $user['coinamount'] - $reward[0]['coinprice'];
      $stmt = $pdo->query("UPDATE users SET coinamount='$balance' where phone='$phone'");
			$stmt->execute();
	  $stmt1 = $pdo->prepare("INSERT into claim (phone, rid) values ('$phone', '$rid')");
			$stmt1->execute();
			
    }
    else {
      header('HTTP/1.1 9999 NOT ENOUGH COIN');
      die(json_encode(array('message' => 'NOT ENOUGH COIN', 'code' => 9999)));
    }
  }
  else {
    header('HTTP/1.1 9998 REWARD DOES NOT EXIST');
    die(json_encode(array('message' => 'REWARD DOES NOT EXIST', 'code' => 9998)));
  }

?>