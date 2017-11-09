<?php
session_start();
//require_once ".../getuserid_script.php";
include(".../pdo_connect.php");

$highscoreArray = array();
$playerArray = array();

$highscoreTable = $pdo->query("SELECT * FROM highscore");
while ($highscoreRow = $highscoreTable->fetch(PDO::FETCH_ASSOC)){
	if ($highscoreRow['gameID'] == $gameID){
		array_push($highscoreArray, $highscoreRow['highscorevalue']);
		array_push($playerIDArray, $highscoreRow['userID']);
	}
}
rsort($highscoreArray);
//print_r(array_values($highscoreArray));
for($n=0; $n<10; $n++){
	echo '<p>';
	echo $highscoreArray[$n]; //player name
	echo $highscoreArray[$n]; //player highscore
	echo '</p>';
}
?>