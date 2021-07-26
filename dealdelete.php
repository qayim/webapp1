<?php
	session_start();
	require_once "pdo.php";

	if ( ! isset($_SESSION['phone']) ) {
		$_SESSION['error'] = "Missing phone number";
		header('Location: deal.php');
		return;
	}

  if ( ! isset($_POST['did']) ) {
		header('Location: deal.php');
		return;
	}

  $phone = $_SESSION['phone'];

  $did = $_POST['did'];
  $stmt = $pdo->prepare("SELECT * from deal where did = :did");
  $stmt->execute(array(":did" => $did));
  $deal = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt1 = $pdo->prepare("DELETE FROM share where did = :did");
  $stmt1->execute(array(":did" => $did));
	$stmt = $pdo->prepare("DELETE FROM deal where did = :did");
  if ($stmt->execute(array(":did" => $did))) {
    // Delete the Logo
    $logo = "uploads/" . $deal[0]['dlogo'];
    unlink($logo);
  }
  else {
    header('HTTP/1.1 9988 Error');
    die(json_encode(array('message' => 'DELETE ERROR', 'code' => 9988)));
  }

?>