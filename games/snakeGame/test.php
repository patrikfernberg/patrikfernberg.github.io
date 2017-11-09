<?php
session_start();
include("pdo_connect.php");

//getuserID-script
$user = $_SESSION['username'];
$userTable = $pdo->query("SELECT * FROM User");
while($row = $userTable->fetch(PDO::FETCH_ASSOC)){
	if($row['username'] == $user){
		$userID = $row["userID"];
	}
}

$score = "INSERT INTO highscore (userID, gameID, highscorevalue)
		VALUES (:userID, :gameID, :highscorevalue)";
		
		$stmt = $pdo->prepare($score);
		$stmt->execute(
			array(
			':userID' => $userID,
			':gameID' => 1,
			':highscorevalue' => $_GET["name"]
			)
		);
		header("refresh:0; url=index.php");
		exit;
?>