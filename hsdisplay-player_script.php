<?php
require_once "getuserid_script.php";

$highscoreArray = array();

$highscoreTable = $pdo->query("SELECT * FROM highscore");
while ($highscoreRow = $highscoreTable->fetch(PDO::FETCH_ASSOC)){
	if ($highscoreRow['userID'] == $userID && $highscoreRow['gameID'] == $gameID){
		array_push($highscoreArray, $highscoreRow['highscorevalue']);
	}
}
rsort($highscoreArray);
//print_r(array_values($highscoreArray));
for($n=0; $n<count($highscoreArray); $n++){
	echo '<p>';
	echo $highscoreArray[$n];
	echo '</p>';
}
?>